<?php

use App\Models\Breed;
use App\Models\Specie;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public Breed $breed;
    public string $title_breed = '';
    public ?int $specie_id = null;
    public Collection $species;

    public function mount(?string $model_id = null)
    {
        $this->species = Specie::all();

        if ($model_id) {
            $this->breed = Breed::findOrFail($model_id);
            $this->title_breed = $this->breed->name;
            $this->specie_id = $this->breed->specie_id;
        }

    }

    public function create(): void
    {
        Breed::create([
            'name' => $this->title_breed,
            'specie_id' => $this->specie_id
        ]);
        $this->dispatch('list_changed');
        $this->dispatch('close_modal');
    }

};
?>


<div wire:click="dispatch('close_modal')"
     class="fixed flex justify-center items-center w-full min-h-screen top-0 right-0 bg-black/20">
    <form class="bg-white p-16 rounded-lg" wire:click.stop wire:submit.prevent="create()">
        <fieldset class="flex flex-col justify-center gap-4">
            <legend class="contents text-center">
                <span>Nouveau caractère</span>
            </legend>
            <x-forms.select wire:model.live="specie_id" :label="'Espèce'" :name="'specie_id'" :options="$this->species" :disabled="'--Selectionner une espèce--'">
                <span class="font-poppins text-red-600 font-semibold">
                    @error('selectedBreed') {{ $message }} @enderror
                </span>
            </x-forms.select>
            <x-forms.input wire:model.live="title_breed" :name="'new-breed'" :type="'text'" :label="'Race'"/>
            <x-forms.submit>
                Créer
            </x-forms.submit>
        </fieldset>
    </form>
</div>
