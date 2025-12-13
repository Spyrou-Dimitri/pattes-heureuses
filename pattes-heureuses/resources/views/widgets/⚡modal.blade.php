<?php

use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    //Composant livewire a afficher
    public ?string $current = null;

    //Potentiellement nul parce que je ne l'utilise pas pour le create
    public ?string $model_id = null;

    #[On('open_modal')]
    public function open(array $payload): void
    {
        $this->current = $payload['form'];
        $this->model_id = $payload['model_id'] ?? null;
    }

    #[On('close_modal')]
    public function close(): void
    {
        $this->current = null;
        $this->model_id = null;
    }

};
?>

<div>
    @if(!is_null($current))
        <livewire:is :component="$current"  :model_id="$model_id"/>
    @endif
</div>
