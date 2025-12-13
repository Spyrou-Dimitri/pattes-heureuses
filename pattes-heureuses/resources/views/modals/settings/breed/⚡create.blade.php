<?php

use App\Models\Breed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public Breed $breed;
    public string $title_breed = '';

    public function mount(?string $model_id = null)
    {
        if ($model_id) {
            $this->breed = Breed::findOrFail($model_id);
            $this->title_breed = $this->breed->name;
        }
    }

    public function create(): void
    {
        Breed::create([
            'name' => $this->title_breed,
        ]);
        $this->dispatch('list_changed');
        $this->dispatch('close_modal');
    }

};
?>


<div wire:click="dispatch('close_modal')"
     class="fixed flex justify-center items-center w-full min-h-screen top-0 right-0 bg-black/20">
    <form class="bg-white p-16 rounded-lg" wire:click.stop wire:submit="create()">
        <fieldset class="flex flex-col justify-center gap-4">
            <legend class="contents text-center">
                <span>Nouveau caractère</span>
            </legend>
            <x-forms.input wire:model="title_breed" :name="'new-breed'" :type="'text'" :label="'Titre'"/>
            <x-forms.submit>
                Créer
            </x-forms.submit>
        </fieldset>
    </form>
</div>
