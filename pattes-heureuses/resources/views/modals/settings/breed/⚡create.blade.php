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
     @keydown.escape.window="$wire.dispatch('close_modal')"
     x-trap.inert.noscroll="true"
     class="fixed flex justify-center items-center w-full min-h-screen top-0 right-0 bg-black/20">
    <form class="bg-white p-16 flex flex-col gap-4 rounded-lg" wire:click.stop wire:submit.prevent="create()">
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
