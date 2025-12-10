<?php

use App\Models\Behavior;
use Livewire\Component;

new class extends Component {
    public Behavior $behavior;

    public function mount(string $model_id)
    {
        $this->behavior = Behavior::findOrFail($model_id);
    }

    public function delete(): void
    {
        $this->behavior->delete();
        $this->dispatch('behavior_list_changed');
        $this->dispatch('close_modal');
    }
};
?>


<div class="absolute top-0 right-0">
    <button wire:click="delete()">
        Êtes-vous sûr ?
    </button>
</div>
