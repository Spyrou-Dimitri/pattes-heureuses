<?php

use App\Enums\AnimalStatus;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

new class extends Component {
    public AnimalStatus $animal_status;
    public Animal $animal;

    public function mount($model_id)
    {
        $this->animal = Animal::findOrFail($model_id);
        $this->animal_status = $this->animal->state;
    }

    protected function rules()
    {
        return [
            'animal_status' => ['required', Rule::enum(AnimalStatus::class)]
        ];
    }

    protected function messages()
    {
        return [
            'animal_status.required' => 'Le :attribute est requis',
            'animal_status.enum' => 'Le :attribute doit être une valeur valide',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'animal_status' => 'status',
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function update_status()
    {
        $this->authorize('change-status', User::class);
        $this->animal->state = $this->animal_status;
        $this->animal->save();
        $this->dispatch('refresh_status');
        $this->dispatch('close_modal');

    }

};
?>


<div wire:click="dispatch('close_modal')"
     class="fixed flex justify-center items-center w-full min-h-screen top-0 right-0 bg-black/20">
    <form class="bg-white p-16 rounded-lg" wire:click.stop wire:submit="update_status()">
        <fieldset class="flex flex-col justify-center gap-4">
            <legend class="contents text-center">
                <span>Changer le status</span>
            </legend>
            <x-forms.select wire:model.blur="animal_status" :label="'Status'" :name="'status'"
                            :options="AnimalStatus::cases()">
                    <span class="font-poppins text-red-600 font-semibold">
                            @error('sexe') {{ $message }} @enderror
                        </span>
            </x-forms.select>
            <x-forms.submit>
                Modifier
            </x-forms.submit>
        </fieldset>
    </form>
</div>
