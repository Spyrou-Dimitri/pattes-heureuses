<?php

use App\Enums\AnimalStatus;
use App\Models\Animal;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {

    #[Computed]
    public function animals_pending()
    {
        return $animals_pending = Animal::where('state', AnimalStatus::PENDING->value)->get();
    }

    public function access_show($id)
    {
        return redirect()->route('animals-show', $id);
    }

};
?>
<div class="flex flex-col gap-12">

    <div class="fixed top-2 left-2 z-50 px-2 py-1 text-white text-sm font-bold rounded bg-black/70">
        <span class="block sm:hidden">XS ( < 640px )</span>
        <span class="hidden sm:block md:hidden">SM ( ≥ 640px )</span>
        <span class="hidden md:block lg:hidden">MD ( ≥ 768px )</span>
        <span class="hidden lg:block xl:hidden">LG ( ≥ 1024px )</span>
        <span class="hidden xl:block 2xl:hidden">XL ( ≥ 1280px )</span>
        <span class="hidden 2xl:block">2XL ( ≥ 1536px )</span>
    </div>
    <?php


    ?>
    <x-admin.section :title="'Bienvenue Dimitri'">
        <ul class="flex flex-col gap-6 md:flex-row md:gap-12">
            <x-cards.stat-card :icons="'paws'"
                               :title="'Nouveaux animaux'"
                               :number="$this->animals_pending->count()">


            </x-cards.stat-card>
            <x-cards.stat-card :icons="'hearth'"
                               :title="'Nouvelles adoptions'"
                               :number="5">

            </x-cards.stat-card>
            <x-cards.stat-card :icons="'paws'"
                               :title="'Nouveaux animaux'"
                               :number="8">

            </x-cards.stat-card>


        </ul>

    </x-admin.section>


    <x-admin.section :title="'Nouveaux animaux'">
        <x-admin.table :header="'new_animals'">
            @foreach($this->animals_pending as $animal_pending)
                <x-admin.tr wire:click="access_show({{ $animal_pending->id }})" wire:key="{{ $animal_pending->id }}">
                    <x-admin.td>
                        <img class="img-table" src="{{asset('img/animal/jean.jpeg')}}" alt="">
                    </x-admin.td>
                    <x-admin.td>
                        {{$animal_pending->name}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$animal_pending->breed->specie->name}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$animal_pending->breed->name}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$animal_pending->age}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$animal_pending->author}}
                    </x-admin.td>

                </x-admin.tr>
            @endforeach

        </x-admin.table>
    </x-admin.section>
    <x-admin.section :title="'Nouvelles adoptions'">
        <x-admin.table :header="'new_adoptions'">


        </x-admin.table>
    </x-admin.section>


</div>
