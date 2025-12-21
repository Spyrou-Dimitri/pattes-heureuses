<?php

use App\Enums\AnimalStatus;
use App\Models\Adoption;
use App\Models\Animal;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {

    #[Computed]
    public function animals_pending()
    {
        return Animal::where('state', AnimalStatus::PENDING->value)->get();
    }

    #[Computed]
    public function adoptions_pending()
    {
        return Adoption::where('status', AnimalStatus::PENDING->value)->get();
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
    <x-admin.section :title="__('admin/dashboard/dashboard.welcome')">
        <ul class="flex flex-col gap-6 md:flex-row md:gap-12">
            <x-cards.stat-card :icons="'paws'"
                               :title="__('admin/dashboard/dashboard.title_new_animals')"
                               :number="$this->animals_pending->count()">


            </x-cards.stat-card>
            <x-cards.stat-card :icons="'hearth'"
                               :title="__('admin/dashboard/dashboard.title_new_adoptions')"
                               :number="$this->adoptions_pending->count()">

            </x-cards.stat-card>
            <x-cards.stat-card :icons="'paws'"
                               :title="__('admin/dashboard/dashboard.title_new_messages')"
                               :number="8">

            </x-cards.stat-card>


        </ul>

    </x-admin.section>


    <x-admin.section :title="__('admin/dashboard/dashboard.title_new_animals')">
        <x-admin.table :header="'new_animals'">
            @foreach($this->animals_pending as $animal_pending)
                <x-admin.tr wire:click="access_show({{ $animal_pending->id }})" wire:key="{{ $animal_pending->id }}">
                    <x-admin.td>
                        <picture>
                            <source media="(min-width:768px)"
                                    srcset="{{asset('upload_img/animals/variants/128x128/' . $animal_pending->avatar)}}">
                            <source media="(min-width:576px)"
                                    srcset="{{asset('upload_img/animals/variants/720x720/' . $animal_pending->avatar)}}">
                            <source media="(max-width:575px)"
                                    srcset="{{asset('upload_img/animals/variants/480x480/' . $animal_pending->avatar)}}">
                            <img class="img-table"
                                 src="{{asset('upload_img/animals/originals/' . $animal_pending->avatar)}}"
                                 alt="Photo de {{$animal_pending->name}}">
                        </picture>
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
    <x-admin.section :title="__('admin/dashboard/dashboard.title_new_adoptions')">
        <x-admin.table :header="'new_adoptions'">
            @foreach($this->adoptions_pending as $adoption_pending)
                <x-admin.tr wire:click="access_show({{ $adoption_pending->id }})" wire:key="{{ $adoption_pending->id }}">
                    <x-admin.td>
                        <picture>
                            <source media="(min-width:768px)"
                                    srcset="{{asset('upload_img/animals/variants/128x128/' . $adoption_pending->animal->avatar)}}">
                            <source media="(min-width:576px)"
                                    srcset="{{asset('upload_img/animals/variants/720x720/' . $adoption_pending->animal->avatar)}}">
                            <source media="(max-width:575px)"
                                    srcset="{{asset('upload_img/animals/variants/480x480/' . $adoption_pending->animal->avatar)}}">
                            <img class="img-table"
                                 src="{{asset('upload_img/animals/originals/' . $adoption_pending->animal->avatar)}}"
                                 alt="Photo de {{$adoption_pending->animal->name}}">
                        </picture>
                    </x-admin.td>
                    <x-admin.td>
                        {{$adoption_pending->animal->name}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$adoption_pending->first_name . ' ' . $adoption_pending->last_name}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$adoption_pending->email}}
                    </x-admin.td>
                    <x-admin.td>
                        @if(is_null($adoption_pending->telephone))
                            Non-spécifié
                        @endif
                        {{$adoption_pending->telephone}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$adoption_pending->created_at}}
                    </x-admin.td>

                </x-admin.tr>
            @endforeach

        </x-admin.table>
    </x-admin.section>


</div>
