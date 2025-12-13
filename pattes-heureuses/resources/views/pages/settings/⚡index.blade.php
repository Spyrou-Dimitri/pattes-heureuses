<?php

use App\Models\Behavior;
use App\Models\Coat;
use App\Models\Specie;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {


};
?>

<div>
    <section class="flex flex-col gap-4">
        <h3 class="h3-article">
            Animaux
        </h3>
        <ul class="flex gap-4 flex-wrap">
            <livewire:livewire.list-settings title="Espèce" modelClass="{{Specie::class}}"/>
            <livewire:livewire.list-settings title="Caractères" modelClass="{{Behavior::class}}"/>
            <livewire:livewire.list-settings title="Pelages" modelClass="{{Coat::class}}"/>
        </ul>


    </section>
</div>

