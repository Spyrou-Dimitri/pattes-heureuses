<?php

use App\Models\Behavior;
use App\Models\Coat;
use App\Models\Specie;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public Specie $specie;
    public string $title_specie = '';

    public function mount(string $model_id)
    {
        $this->specie = Specie::findOrFail($model_id);
        $this->title_specie = $this->specie->name;
    }

    public function edit(): void
    {
        $this->specie->name = $this->title_specie;
        $this->specie->save();
        $this->dispatch('list_changed');
        $this->dispatch('close_modal');
    }


};
?>
<div wire:click="dispatch('close_modal')"
     class="fixed flex justify-center items-center w-full min-h-screen top-0 right-0 bg-black/20">
    <form class="bg-white p-16 rounded-lg" wire:click.stop wire:submit="edit()">
        <fieldset class="flex flex-col justify-center gap-4">
            <legend class="contents text-center">
                <span>Modifier</span>
            </legend>
            <x-forms.input :name="'change-specie'" wire:model="title_specie" :type="'text'" :label="'Titre'"/>
        </fieldset>
        <div class="mt-6 flex justify-between">
            <button type="submit" class="delete">
                Modifier
            </button>
            <a wire:click="dispatch('close_modal')" class="cta-primary">Retour</a>

        </div>
    </form>
</div>
