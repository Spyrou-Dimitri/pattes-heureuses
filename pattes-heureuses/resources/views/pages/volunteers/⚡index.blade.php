<?php

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public string $term = '';
    public string $filter_tag = '';


    #[Computed]
    public function staff()
    {
        return $staff = User::select('avatar', 'first_name', 'last_name', 'email', 'telephone', 'id')
            ->where('first_name', 'like', '%' . $this->term . '%')
            ->orderBy('name', 'asc')
            ->get();
    }
    public function access_user($id)
    {
        return redirect()->route('volunteers-show', $id);
    }
};
?>

<div>
    <x-admin.section :title="'Liste du personnels'">
        <div class="flex flex-col gap-4 justify-between md:items-center md:flex-row flex-wrap">
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
                <x-basics.cta :title="'Créer une nouveau profil'"
                              :href="route('volunteers-create')"
                             >
                    Nouveau
                </x-basics.cta>
            </div>
        </div>
        <x-admin.table :header="'volunteers'">
            @foreach($this->staff as $user)
                <x-admin.tr wire:click="access_user({{$user->id}})" wire:key="{{$user->id}}">
                    <x-admin.td>
                        <img class="img-table" src="{{asset('img/animal/jean.jpeg')}}" alt="">
                    </x-admin.td>
                    <x-admin.td>
                        {{$user->first_name . ' ' . $user->last_name}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$user->email}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$user->telephone}}
                    </x-admin.td>
                    <x-admin.td>
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open">…</button>
                            <div x-show="open" @click.outside="open = false" class="absolute bg-white shadow p-2">
                                <a href="#" wire:click="delete({{ $user->id }})">Supprimer</a>
                                <a href="#">Modifier</a>
                            </div>
                        </div>
                    </x-admin.td>
                </x-admin.tr>
            @endforeach

        </x-admin.table>


    </x-admin.section>
</div>
