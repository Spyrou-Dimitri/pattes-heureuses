<?php

use App\Enums\AdoptionStatus;
use App\Enums\AnimalStatus;
use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Validation\Rule;
use Livewire\Component;

new class extends Component {
    public AnimalStatus $animal_status;
    public AdoptionStatus $adoption_status;
    public Adoption $adoption;

    public function mount($model_id)
    {
        $this->adoption = Adoption::findOrFail($model_id);
        $this->adoption_status = $this->adoption->status;
    }

    protected function rules()
    {
        return [
            'adoption_status' => ['required', Rule::enum(AdoptionStatus::class)]
        ];
    }

    protected function messages()
    {
        return [
            'adoption_status.required' => 'Le :attribute est requis',
            'adoption_status.enum' => 'Le :attribute doit être une valeur valide',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'adoption_status' => 'status',
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }
    public function update_status()
    {
        $this->adoption->status = $this->adoption_status;
        $this->adoption->save();
        $this->dispatch('refresh');
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
            <div class="flex flex-col gap-2 w-full">
                <x-forms.select wire:model.blur="adoption_status" :label="'Status'" :name="'status'"
                                :options="AdoptionStatus::cases()">
                </x-forms.select>
                <span class="font-poppins text-red-600 font-semibold">
                            @error('sexe') {{ $message }} @enderror
                        </span>
            </div>
            <x-forms.submit>
                Modifier
            </x-forms.submit>
        </fieldset>
    </form>
</div>
