<?php

use App\Models\Animal;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {

    public string $term = '';
    public string $filter_tag = '';



    #[Computed]
    public function animals()
    {
        return $animals = Animal::select('avatar', 'name', 'type', 'breed', 'state', 'id')
            ->where('name', 'like', '%' . $this->term . '%')
            ->orderBy('name', 'asc')
            ->get();
        dd($animals);
    }

    public function set_tag($state)
    {
        $this->filter_tag = $state;
    }
    public function apply_tag()
    {
        if ($this->filter_tag) {
            return $this->animals = Animal::where('state', $this->filter_tag)->get();
        }
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
                    <a href="#all" wire:click="set_tag('all')" class="filter_link {{$filter_tag === 'all' ? 'active': ''}}">Tous</a>
                </li>
                <li>
                    <a href="#adoptable" wire:click="set_tag('adoptable')" class="filter_link {{$filter_tag === 'adoptable' ? 'active': ''}}">Adoptable</a>
                </li>
                <li>
                    <a href="#underCare" wire:click="set_tag('underCare')" class="filter_link {{$filter_tag === 'underCare' ? 'active': ''}}">En soin</a>
                </li>
                <li>
                    <a href="#adopted" wire:click="set_tag('adopted')" class="filter_link {{$filter_tag === 'adopted' ? 'active': ''}}">Adopté</a>
                </li>
                <li>
                    <a href="#deceased" wire:click="set_tag('deceased')" class="filter_link {{$filter_tag === 'deceased' ? 'active': ''}}">Décédé</a>
                </li>
            </ul>
            <x-forms.input :type="'search'" :name="'animal-search'" :label="'Rechercher un animal'"
                           :placeholder="'Barre de recherche'"/>

            <div class="flex justify-between md:gap-4 md:justify-start">
                <a href="" class="cta-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="20" height="20" viewBox="0 0 24 24">
                        <path stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 4.6c0-.56 0-.84.109-1.054a1 1 0 0 1 .437-.437C3.76 3 4.04 3 4.6 3h14.8c.56 0 .84 0 1.054.109a1 1 0 0 1 .437.437C21 3.76 21 4.04 21 4.6v1.737c0 .245 0 .367-.028.482a.998.998 0 0 1-.12.29c-.061.1-.148.187-.32.36l-6.063 6.062c-.173.173-.26.26-.322.36a.998.998 0 0 0-.12.29c-.027.115-.027.237-.027.482V17l-4 4v-6.337c0-.245 0-.367-.028-.482a1 1 0 0 0-.12-.29c-.061-.1-.148-.187-.32-.36L3.468 7.47c-.173-.173-.26-.26-.322-.36a1 1 0 0 1-.12-.29C3 6.704 3 6.582 3 6.337V4.6Z"/>
                    </svg>
                    <span>
                    Filtres
                </span>
                </a>
                <x-basics.cta :title="'Créer une nouvelle fiche'"
                              :href="route('animals-create')"
                              :cta_title="'Créer une nouvelle fiche'">
                    Nouveau
                </x-basics.cta>
            </div>
        </div>
        <x-admin.table :header="'animals'">
            @foreach($this->animals as $animal)
                <x-admin.tr wire:key="{{$animal->id}}">
                    <x-admin.td>
                        <img class="img-table" src="{{asset('img/animal/jean.jpeg')}}" alt="">
                    </x-admin.td>
                    <x-admin.td>
                        {{$animal->name}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$animal->type}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$animal->breed}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$animal->state}}
                    </x-admin.td>
                    <x-admin.td>
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open">…</button>
                            <div x-show="open" @click.outside="open = false" class="absolute bg-white shadow p-2">
                                <a href="#" wire:click="delete({{ $animal->id }})">Supprimer</a>
                                <a href="#">Modifier</a>
                            </div>
                        </div>
                    </x-admin.td>
                </x-admin.tr>
            @endforeach

        </x-admin.table>


    </x-admin.section>
</div>

