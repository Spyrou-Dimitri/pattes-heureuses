<?php

use App\Models\Specie;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public Specie $specie;
    public string $title_specie = '';

    public function mount(?string $model_id = null)
    {
        if ($model_id) {
            $this->specie = Specie::findOrFail($model_id);
            $this->title_specie = $this->specie->name;
        }
    }

    public function create(): void
    {
        Specie::create([
            'name' => $this->title_specie,
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
    <form class="bg-white flex flex-col gap-4 p-16 rounded-lg" wire:click.stop wire:submit="create()">
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
            <x-forms.input wire:model="title_specie" :name="'new-specie'" :type="'text'" :label="'Titre'"/>
            <x-forms.submit>
                Créer
            </x-forms.submit>
        </fieldset>
    </form>
</div>
