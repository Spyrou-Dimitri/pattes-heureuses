<?php

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public string $old_password = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';
    public User $user;


    public function mount($model_id)
    {
        $this->user = User::findOrFail($model_id);
    }

    public function rules()
    {
        return [
            'old_password' => 'required|current_password',
            'new_password' => 'required|min:6|confirmed',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'old_password' => 'Ancien mot de passe',
            'new_password' => 'Nouveau mot de passe',
        ];
    }


    public function updated($property)
    {
        $this->validateOnly($property);
    }


    public function update_password()
    {
        $validated = $this->validate();

        $this->user->password = Hash::make($validated['new_password']);
        $this->user->save();
        $this->dispatch('close_modal');

    }
}
?>


<div wire:click="dispatch('close_modal')"
     @keydown.escape.window="$wire.dispatch('close_modal')"
     x-trap.inert.noscroll="true"
     class="fixed flex justify-center items-center w-full min-h-screen top-0 right-0 bg-black/20">
    <form class="bg-white flex flex-col gap-4 p-16 rounded-lg" wire:click.stop wire:submit="update_password()">
        <button type="button" wire:click="dispatch('close_modal')"
                class="cursor-pointer w-fit p-2 self-end rounded-lg bg-orange-cta">
            <svg viewBox="0 0 24 24" fill="none" width="28" height=28" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_iconCarrier">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z"
                          fill="#FFFFFF"></path>
                </g>
            </svg>
        </button>
        <fieldset class="flex flex-col justify-center gap-4">
            <legend class="contents text-center">
                <span>Changer votre mot de passe</span>
            </legend>
            <x-forms.input placeholder="*******" wire:model.live="old_password" :name="'old-password'"
                           placeholder="*******"
                           :type="'password'" :label="'Ancien mot de passe'">
                <span class="font-poppins text-red-600 font-semibold">
                    @error('old_password') {{ $message }} @enderror
                </span>
            </x-forms.input>
            <x-forms.input wire:model.live="new_password" :name="'new-password'" placeholder="*******"
                           :type="'password'"
                           :label="'Nouveau mot de passe'">
                <span class="font-poppins text-red-600 font-semibold">
                    @error('new_password') {{ $message }} @enderror
                </span>
            </x-forms.input>
            <x-forms.input wire:model.live="new_password_confirmation" :name="'new-password-confirm'"
                           placeholder="*******"
                           :type="'password'" :label="'Confirmer nouveau mot de passe'">
                <span class="font-poppins text-red-600 font-semibold">
                    @error('new_password_confirmation') {{ $message }} @enderror
                </span>
            </x-forms.input>
            <x-forms.submit>
                Changer le mot de passe
            </x-forms.submit>
        </fieldset>
    </form>
</div>
