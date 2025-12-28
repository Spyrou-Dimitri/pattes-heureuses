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
     class="fixed flex justify-center items-center w-full min-h-screen top-0 right-0 bg-black/20">
    <form class="bg-white p-16 rounded-lg" wire:click.stop wire:submit="update_password()">
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
