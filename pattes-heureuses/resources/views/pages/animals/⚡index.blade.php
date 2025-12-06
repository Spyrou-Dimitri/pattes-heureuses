<?php

use App\Enums\AnimalStatus;
use App\Enums\SexeAnimal;
use App\Models\Animal;
use App\Models\Behavior;
use App\Models\Breed;
use App\Models\Coat;
use App\Models\Specie;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {

    public string $term = '';
    public array $selectedSpecies = [];

    public string $filter_tag = '';
    public Collection $species;
    public Collection $breeds;
    public Collection $coats;
    public Collection $behaviors;
    public array $tolerances = [
        'accept_dogs' => false,
        'accept_cats' => false,
        'accept_kids' => false,
    ];


    public function mount()
    {
        $this->species = Specie::orderBy('name')->get();
        $this->coats = Coat::orderBy('name')->get();
        $this->behaviors = Behavior::orderBy('name')->get();
    }

    public function updatedSelectedSpecies()
    {
        unset($this->filteredBreeds);
    }

    #[Computed]
    public function filteredBreeds()
    {
        return Breed::whereIn('specie_id', $this->selectedSpecies)->get();
    }


    #[Computed]
    public function animals()
    {
        if ($this->filter_tag === '') {
            return $animals = Animal::where('name', 'like', '%' . $this->term . '%')
                ->orderBy('name', 'asc')
                ->get();
        } else {
            return $animals = Animal::with('breed.specie')
                ->where('state', $this->filter_tag)
                ->orderBy('name', 'asc')
                ->get();
        }

    }

    public function set_tag($state)
    {
        $this->filter_tag = $state;
        unset($this->animals);
    }

    public function access_show($id)
    {
        return redirect()->route('animals-show', $id);
    }


};
?>


<div class="flex flex-col gap-12">
    <x-admin.section :title="'Statistiques'">
        <ul class="flex flex-col gap-6 md:flex-row md:gap-12">
            <x-cards.stat-card :icons="'paws'"
                               :title="'Animaux'"
                               :number="3">


            </x-cards.stat-card>
            <x-cards.stat-card :icons="'dog'"
                               :title="'Chiens'"
                               :number="5">

            </x-cards.stat-card>
            <x-cards.stat-card :icons="'cat'"
                               :title="'Chats'"
                               :number="8">
            </x-cards.stat-card>

        </ul>

    </x-admin.section>
    <x-admin.section :title="'Liste des animaux'">
        <div class="flex flex-col gap-4 justify-between md:items-center md:flex-row flex-wrap">
            <ul class="flex gap-4 md:gap-8 text-poppins flex-wrap">
                <li>
                    <a href="#all" wire:click="set_tag('')" class="filter_link {{$filter_tag === '' ? 'active': ''}}">Tous</a>
                </li>
                @foreach(AnimalStatus::cases() as $status)
                    <li>
                        <a href="#{{$status->value}}" wire:click="set_tag('{{$status->value}}')"
                           class="filter_link {{ $filter_tag === $status->value ? 'active' : '' }}">{!! __('admin/filter_tag.' .$status->value)!!}</a>
                    </li>
                @endforeach

            </ul>

            <x-forms.input :type="'search'" :name="'animal-search'" :label="'Rechercher un animal'"
                           :placeholder="'Barre de recherche'"/>

            <div class="flex justify-between md:gap-4 md:justify-start" x-data="{open: false}">
                <button class="cta-secondary cursor-pointer" @click.stop="open = !open">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="20" height="20" viewBox="0 0 24 24">
                        <path stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 4.6c0-.56 0-.84.109-1.054a1 1 0 0 1 .437-.437C3.76 3 4.04 3 4.6 3h14.8c.56 0 .84 0 1.054.109a1 1 0 0 1 .437.437C21 3.76 21 4.04 21 4.6v1.737c0 .245 0 .367-.028.482a.998.998 0 0 1-.12.29c-.061.1-.148.187-.32.36l-6.063 6.062c-.173.173-.26.26-.322.36a.998.998 0 0 0-.12.29c-.027.115-.027.237-.027.482V17l-4 4v-6.337c0-.245 0-.367-.028-.482a1 1 0 0 0-.12-.29c-.061-.1-.148-.187-.32-.36L3.468 7.47c-.173-.173-.26-.26-.322-.36a1 1 0 0 1-.12-.29C3 6.704 3 6.582 3 6.337V4.6Z"/>
                    </svg>
                    <span>
                    Filtres
                </span>
                </button>
                <div
                    x-show="open"
                    x-transition.opacity
                    @click="open = false"
                    class="fixed inset-0 bg-black/50 z-2">
                </div>
                <div x-show="open" @click.outside="open = false"
                     class="fixed origin-center z-3 -translate-y-1/2 p-4 lg:p-12 -translate-x-1/2 top-1/2 w-full left-1/2 max-w-[90%] max-h-[90vh] bg-white overflow-y-scroll flex flex-col gap-12">
                    <div @click="open = false" class="cursor-pointer w-fit p-2 self-end rounded-lg bg-orange-cta">
                        <svg viewBox="0 0 24 24" fill="none" width="28" height=28" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z"
                                      fill="#FFFFFF"></path>
                            </g>
                        </svg>
                    </div>
                    <form action="" method="get" class="flex flex-col gap-8">
                        <div class="flex flex-col gap-8 lg:grid lg:grid-cols-2 lg:gap-x-16  ">
                            <fieldset class="flex flex-col gap-4">
                                <legend>
                                    Type
                                </legend>
                                <div class="flex flex-row gap-2 flex-wrap sm:gap-6">
                                    @foreach($species as $specie)
                                        <x-forms.checkbox :value="$specie->id" :name="$specie->name" :type="'checkbox'"
                                                          :label="$specie->name"
                                                          wire:model.live="selectedSpecies"/>
                                    @endforeach
                                </div>
                            </fieldset>
                            <fieldset class="flex flex-col gap-4">
                                <legend>
                                    Races
                                </legend>
                                <div class="flex flex-row gap-2 flex-wrap sm:gap-6">
                                    @foreach($this->filteredBreeds as $breed)
                                        <x-forms.checkbox :value="$breed->id" :name="$breed->name" :type="'checkbox'"
                                                          :label="$breed->name"/>
                                    @endforeach
                                </div>
                            </fieldset>
                        </div>
                        <div class="flex flex-col gap-8  lg:grid lg:grid-cols-2 lg:gap-x-16  ">
                            <div class="flex flex-col gap-8  sm:grid grid-cols-2 sm:gap-x-2">
                                <fieldset class="flex flex-col gap-4">
                                    <legend>
                                        Sexe
                                    </legend>
                                    <div class="flex flex-row gap-2 flex-wrap sm:gap-6">
                                        @foreach(SexeAnimal::cases() as $sexe)
                                            <x-forms.checkbox :value="$sexe->value" :name="$sexe->name"
                                                              :type="'checkbox'"
                                                              :label="$sexe->value"/>
                                        @endforeach
                                    </div>
                                </fieldset>
                                <fieldset class="flex flex-col gap-4">
                                    <legend>
                                        Tranches d'age
                                    </legend>
                                    @php
                                        $ageTranches = [
                                            "0-4",
                                            "5-9",
                                            "10-14",
                                            "15-20"
                                            ];
                                    @endphp
                                    <x-forms.select :hasLabel="false" :options="$ageTranches" :name="'age-range'"
                                                    :label="'Age'"/>
                                </fieldset>
                            </div>
                            <fieldset class="flex flex-col gap-4">
                                <legend>
                                    Pelages
                                </legend>
                                <div class="flex flex-row gap-2 flex-wrap sm:gap-6">
                                    @foreach($this->coats as $coat)
                                        <x-forms.checkbox :value="$coat->id" :name="$coat->name" :type="'checkbox'"
                                                          :label="$coat->name"/>
                                    @endforeach
                                </div>
                            </fieldset>
                        </div>
                        <div class="flex flex-col gap-8  lg:grid lg:grid-cols-2 lg:gap-x-16 ">
                            <fieldset class="flex flex-col gap-4">
                                <legend>
                                    Caractères
                                </legend>
                                <div class="flex flex-row gap-2 flex-wrap sm:gap-6">
                                    @foreach($this->behaviors as $behavior)
                                        <x-forms.checkbox :value="$behavior->id" :name="$behavior->name"
                                                          :type="'checkbox'"
                                                          :label="$behavior->name"/>
                                    @endforeach
                                </div>

                            </fieldset>
                            <fieldset class="flex flex-col gap-4">
                                <legend>
                                    Tolérances
                                </legend>
                                <div class="flex flex-row gap-2 flex-wrap sm:gap-6">
                                    <x-forms.checkbox :type="'checkbox'" :name="'accept_cats'" :label="'Chats'"
                                                      :value="1"/>
                                    <x-forms.checkbox :type="'checkbox'" :name="'accept_dogs'" :label="'Chiens'"
                                                      :value="1"/>
                                    <x-forms.checkbox :type="'checkbox'" :name="'accept_kids'" :label="'Enfants'"
                                                      :value="1"/>
                                </div>
                            </fieldset>
                        </div>
                        <x-forms.submit>
                            Appliquer
                        </x-forms.submit>
                    </form>
                </div>
                <x-basics.cta :title="'Créer une nouvelle fiche'"
                              :href="route('animals-create')"
                              :cta_title="'Créer une nouvelle fiche'">
                    Nouveau
                </x-basics.cta>
            </div>
        </div>
        <x-admin.table :header="'animals'">
            @foreach($this->animals as $animal)
                <x-admin.tr wire:click="access_show({{ $animal->id }})" wire:key="{{ $animal->id }}">
                    <x-admin.td>
                        <img class="img-table" src="{{asset('img/animal/jean.jpeg')}}" alt="">
                    </x-admin.td>
                    <x-admin.td>
                        {{$animal->name}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$animal->breed->specie->name}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$animal->breed->name}}
                    </x-admin.td>
                    <x-admin.td>
                        {{ __('admin/filter_tag.' . $animal->state) }}
                    </x-admin.td>
                    <x-admin.td x-data="{ open: false }">
                        <button @click.stop="open = !open" class="text-8xl text-center">
                            …
                        </button>
                        <div x-show="open" @click.outside="open = false" class="absolute bg-white shadow p-2">
                            <a href="#" wire:click="delete({{ $animal->id }})">Supprimer</a>
                            <a href="#">Modifier</a>
                        </div>
                    </x-admin.td>
                </x-admin.tr>
            @endforeach

        </x-admin.table>
    </x-admin.section>
</div>

