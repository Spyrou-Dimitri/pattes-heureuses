<?php

use App\Enums\AdoptionStatus;
use App\Enums\AnimalStatus;
use App\Enums\SexeAnimal;
use App\Models\Adoption;
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

    public string $filter_tag = '';

    #[Computed]
    public function adoptions()
    {


        $adoptions = Adoption::query()
            ->join('animals', 'adoptions.animal_id', '=', 'animals.id')
            ->select('adoptions.*');

        //Filtre barre de recherche
        if ($this->term !== '') {
            $adoptions->where('first_name', 'like', '%' . $this->term . '%')
                ->orWhere('last_name', 'like', '%' . $this->term . '%')
                ->orWhereHas('animal', function ($name) {
                    $name->where('name', 'like', '%' . $this->term . '%');
                });
        }

        //Filtres status
        if ($this->filter_tag !== '') {
            $adoptions->where('status', $this->filter_tag);
        }

        return $adoptions->with('animal')->orderBy('name', 'asc')->paginate(8);

    }

    public function set_tag($state)
    {
        $this->filter_tag = $state;
        unset($this->adoptions);

    }

    public function access_show($id)
    {
        return redirect()->route('adoptions-show', $id);
    }


};
?>


<div class="flex flex-col gap-12">
    <x-admin.section :title="__('admin/animals/index.stats_title')">
        <ul class="flex flex-col gap-6 justify-between items-center md:grid md:grid-cols-9 md:gap-12">
            <x-cards.stat-card :icons="'paws'"
                               :title="'Adoptions'"
                               :number="Adoption::count()"
            />
            <x-cards.stat-card :icons="'dog'"
                               :title="'Adoptions réussies'"
                               :number="Adoption::where('status', AdoptionStatus::Completed)->count()"
            />

            <x-cards.stat-card :icons="'cat'"
                               :title="'Adoptions en cours'"
                               :number="Adoption::where('status', AdoptionStatus::InProgress)->count()"
            />

        </ul>

    </x-admin.section>
    <x-admin.section :title="__('admin/animals/index.table_title')">
        <div class="flex flex-col gap-4 justify-between md:items-center md:flex-row flex-wrap">
            <ul class="flex gap-4 md:gap-8 text-poppins flex-wrap">
                <li>
                    <a href="#all" wire:click="set_tag('')"
                       class="filter_link {{$filter_tag === '' ? 'active': ''}}">{{__('admin/animals/index.filter_tag_all')}}</a>
                </li>
                @foreach(AdoptionStatus::cases() as $status)
                    <li>
                        <a href="#{{$status->value}}" wire:click="set_tag('{{$status->value}}')"
                           class="filter_link {{ $filter_tag === $status->value ? 'active' : '' }}">{{$status->label()}}</a>
                    </li>
                @endforeach
            </ul>
            <x-forms.input :term="'term'" :type="'search'" :name="'adoption-search'"
                           :label="__('client/animals/index/landing.search-bar-label')"
                           :placeholder="__('admin/animals/index.search_bar_placeholder')"/>
            <div class="flex justify-between md:gap-4 md:justify-start">
                <x-basics.cta :title="__('admin/dashboard/dashboard.title_new_animals')"
                              :href="route('adoptions-create')"
                              :cta_title="'Créer une nouvelle adoption'">
                    {{__('admin/animals/index.new_animal')}}
                </x-basics.cta>
            </div>
        </div>
        <x-admin.table :header="'adoptions'">
            @foreach($this->adoptions as $adoption)
                <x-admin.tr wire:click="access_show({{ $adoption->id }})" wire:key="{{ $adoption->id }}">
                    <x-admin.td>
                        @if(str_starts_with($adoption->animal->avatar, 'public/img/animal/'))
                            <img src="{{asset(str_replace('public/', '', $adoption->animal->avatar))}}"
                                 alt="Photo de {{$adoption->animal->name}}"
                                 class="img-table">
                        @else
                            <picture>
                                <source media="(min-width:768px)"
                                        srcset="{{Storage::disk('s3')->url('upload_img/animals/variants/128x128/' . $adoption->animal->avatar)}}">
                                <source media="(min-width:576px)"
                                        srcset="{{Storage::disk('s3')->url('upload_img/animals/variants/720x720/' . $adoption->animal->avatar)}}">
                                <source media="(max-width:575px)"
                                        srcset="{{Storage::disk('s3')->url('upload_img/animals/variants/480x480/' . $adoption->animal->avatar)}}">
                                <img class="img-table"
                                     src="{{Storage::disk('s3')->url('upload_img/animals/originals/' . $adoption->animal->avatar)}}"
                                     alt="Photo de " . {{$adoption->animal->name}}>
                            </picture>
                        @endif
                    </x-admin.td>
                    <x-admin.td>
                        {{$adoption->animal->name}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$adoption->first_name . ' ' .$adoption->last_name}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$adoption->email}}
                    </x-admin.td>
                    <x-admin.td>
                        <span
                            class="{{$adoption->status->color()}} border-2 p-2 rounded-lg bg-gray-50 font-poppins font-semibold">
                            {{$adoption->status->label() }}
                        </span>
                    </x-admin.td>

                </x-admin.tr>
            @endforeach
        </x-admin.table>
        <div class="mt-4">
            {{ $this->adoptions->links() }}
        </div>

    </x-admin.section>
</div>




