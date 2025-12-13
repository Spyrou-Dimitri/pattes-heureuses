<?php

use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public ?string $current = null;
    public string $key = '';
    public ?string $model_id = null;

    #[On('open_modal')]
    public function open(array $payload): void
    {
        $this->current = $payload['form'];
        $this->model_id = $payload['model_id'] ?? null;
        $this->key = uniqid();
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
        <livewire:is :component="$current" :key="$key" :model_id="$model_id"/>
    @endif
</div>
