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
            ->orWhere('last_name', 'like', '%' . $this->term . '%')
            ->orderBy('first_name', 'asc')
            ->paginate(8);
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
            <x-forms.input :term="'term'" :type="'search'" :name="'animal-search'" :label="'Rechercher un animal'"
                           :placeholder="'Barre de recherche'"/>
            @can('create', User::class)
                <div class="flex justify-between md:gap-4 md:justify-start">
                    <x-basics.cta :title="'Créer une nouveau profil'"
                                  :href="route('volunteers-create')"
                    >
                        Nouveau
                    </x-basics.cta>
                </div>
            @endcan
        </div>
        <x-admin.table :header="'volunteers'">
            @foreach($this->staff as $user)
                <x-admin.tr wire:click="access_user({{$user->id}})" wire:key="{{$user->id}}">
                    <x-admin.td>
                        @if(str_starts_with($user->avatar, 'public/img/personnel/'))
                            <img src="{{asset(str_replace('public/', '', $user->avatar))}}"
                                 alt="Photo de {{$user->name}}"
                                 class="img-table">
                        @else
                            <picture>
                                <source media="(min-width:768px)"
                                        srcset="{{asset('upload_img/animals/variants/128x128/' . $user->avatar)}}">
                                <source media="(min-width:576px)"
                                        srcset="{{asset('upload_img/users/variants/720x720/' . $user->avatar)}}">
                                <source media="(max-width:575px)"
                                        srcset="{{asset('upload_img/users/variants/480x480/' . $user->avatar)}}">
                                <img class="img-table" src="{{asset('upload_img/users/originals/' . $user->avatar)}}"
                                     alt="Photo de " . {{$user->name}}>
                            </picture>
                        @endif
                    </x-admin.td>
                    <x-admin.td>
                        {{$user->last_name}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$user->first_name}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$user->email}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$user->telephone}}
                    </x-admin.td>
                </x-admin.tr>
            @endforeach

        </x-admin.table>
        <div class="mt-4">
            {{ $this->staff->links() }}
        </div>

    </x-admin.section>
</div>
