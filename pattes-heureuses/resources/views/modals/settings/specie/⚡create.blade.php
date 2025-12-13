<?php

use App\Models\Specie;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public Specie $coat;
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
     class="fixed flex justify-center items-center w-full min-h-screen top-0 right-0 bg-black/20">
    <form class="bg-white p-16 rounded-lg" wire:click.stop wire:submit="create()">
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
