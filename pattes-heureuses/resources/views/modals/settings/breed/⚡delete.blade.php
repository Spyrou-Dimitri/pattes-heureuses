<?php

use App\Models\Breed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public Breed $breed;

    public function mount(string $model_id)
    {
        $this->breed = Breed::findOrFail($model_id);
    }

    public function delete(): void
    {
        $this->breed->delete();
        $this->dispatch('list_changed');
        $this->dispatch('close_modal');
    }

};
?>


<div wire:click="dispatch('close_modal')"
     @keydown.escape.window="$wire.dispatch('close_modal')"
     x-trap.inert.noscroll="true"
     x-data
     class="fixed flex justify-center items-center w-full min-h-screen top-0 right-0 bg-black/20">
    <form wire:click.stop class="bg-white p-16 flex flex-col gap-4 rounded-lg" wire:submit="delete()">
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
            <div class="p-4 bg-red-100 w-20 mx-auto rounded-lg ">
                <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" width="48" height="48"
                     viewBox="0 0 24 24">
                    <path stroke="#E7000B" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16m-4 0-.27-.812c-.263-.787-.394-1.18-.637-1.471a2 2 0 0 0-.803-.578C13.938 3 13.524 3 12.694 3h-1.388c-.829 0-1.244 0-1.596.139a2 2 0 0 0-.803.578c-.243.29-.374.684-.636 1.471L8 6m10 0v10.2c0 1.68 0 2.52-.327 3.162a3 3 0 0 1-1.311 1.311C15.72 21 14.88 21 13.2 21h-2.4c-1.68 0-2.52 0-3.162-.327a3 3 0 0 1-1.311-1.311C6 18.72 6 17.88 6 16.2V6m8 4v7m-4-7v7"/>
                </svg>
            </div>
            <legend class="contents text-center">
                <span>Supprimer</span>
            </legend>
            <p class="text-center text-xl">
                Êtes vous sur de vouloir supprimer cet élément ?
            </p>
        </fieldset>
        <div class="mt-6 flex justify-between">
            <button type="submit" class="delete">
                Supprimer
            </button>
            <button wire:click="dispatch('close_modal')" class="cta-primary">Retour</button>

        </div>
    </form>
</div>
