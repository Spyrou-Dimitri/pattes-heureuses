<?php

use App\Models\Animal;
use Livewire\Component;

new class extends Component {
    public $animal;
    public $animal_profil_value;
    public $animal_behavior_value;

    public function mount($id)
    {
        $this->animal = Animal::findOrFail($id);
        $this->animal_profil_value = [
            'name' => $this->animal->name,
            'type' => $this->animal->breed->specie->name,
            'breed' => $this->animal->breed->name,
            'age' => $this->animal->age,
            'coat' => $this->animal->coats->pluck('name')->join(' / '),
        ];
        $this->animal_behavior_value = [
            'place' => $this->animal->place,
            'accept_dogs' => $this->animal->accept_dogs,
            'accept_kids' => $this->animal->accept_kids,
            'accept_cats' => $this->animal->accept_cats,
        ];
    }
};
?>

<div class="">
    <x-admin.section :title="'Fiche de' . ' ' . $this->animal->name"
                     :align="true">
        <div class="flex w-full flex-col gap-6 lg:grid lg:grid-cols-2">
            <x-cards.animal-data :name="$this->animal->name"
                                 :sexe="$this->animal->sexe"
                                 :data_animals_profile="$this->animal_profil_value"
                                 :data_animals_behavior="$this->animal_behavior_value"
            >
            </x-cards.animal-data>
            <img src="{{asset('img/animal/jean.jpeg')}}" alt="Photo de jean"
                 class="w-full aspect-square rounded-lg shadow-main-blue-lg">
        </div>
        <section class="flex flex-col bg-white border border-main-blue rounded-lg p-6 gap-4">
            <h3 class="h3-article">
                Descriptions
            </h3>
            <p class="font-poppins text-xl">
                {{$this->animal->description}}
            </p>
        </section>
    </x-admin.section>
</div>
