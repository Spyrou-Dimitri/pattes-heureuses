@php use App\Enums\SexeAnimal; @endphp
@props([
    'animals',
    'species',
    'breeds',
    'coats',
    'behaviors',
    ])

<x-layouts.section :py="'basic-no-py'" :bg="'no-bg'" class="md:col-span-2">
    <x-layouts.grid class="md:gap-4">
        <div class="flex flew-wrap justify-between md:col-span-full">
            <h3 class="h3-article md:col-span-full">
                {{__('client/animals/index/landing.Result')}} ({{$animals->count()}})
            </h3>
            <button class="filters-button" id="filters-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="20" height="20" viewBox="0 0 24 24">
                    <path stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 4.6c0-.56 0-.84.109-1.054a1 1 0 0 1 .437-.437C3.76 3 4.04 3 4.6 3h14.8c.56 0 .84 0 1.054.109a1 1 0 0 1 .437.437C21 3.76 21 4.04 21 4.6v1.737c0 .245 0 .367-.028.482a.998.998 0 0 1-.12.29c-.061.1-.148.187-.32.36l-6.063 6.062c-.173.173-.26.26-.322.36a.998.998 0 0 0-.12.29c-.027.115-.027.237-.027.482V17l-4 4v-6.337c0-.245 0-.367-.028-.482a1 1 0 0 0-.12-.29c-.061-.1-.148-.187-.32-.36L3.468 7.47c-.173-.173-.26-.26-.322-.36a1 1 0 0 1-.12-.29C3 6.704 3 6.582 3 6.337V4.6Z"/>
                </svg>
                <span>
                    {{__('admin/animals/index.filter')}}
                </span>
            </button>
        </div>

        <div class="md:col-span-full">
            <div class="overlay-filters" id="overlay-filters">
            </div>
            <div class="filters-container" id="filters-container">
                <button type="button" class="filters-close-button" id="filters-close-button">
                    <svg viewBox="0 0 24 24" fill="none" width="28" height=28" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_iconCarrier">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z"
                                  fill="#FFFFFF">

                            </path>
                        </g>
                    </svg>
                </button>
                <form method="GET" action="{{route('animals.index')}}" class="flex flex-col gap-8">
                    <div class="flex flex-col gap-8 lg:grid lg:grid-cols-2 lg:gap-x-16">
                        <fieldset class="flex flex-col gap-4">
                            <legend>{{ __('admin/animals/index.specie') }}</legend>
                            <div class="flex flex-row gap-2 flex-wrap sm:gap-6">
                                @foreach($species as $specie)
                                    <x-forms.checkbox
                                        :name="'species[]'"
                                        :value="$specie->id"
                                        :label="$specie->name"
                                    />
                                @endforeach
                            </div>
                        </fieldset>
                        <fieldset class="flex flex-col gap-4">
                            <legend>{{ __('admin/animals/index.breed') }}</legend>
                            <div class="flex flex-row gap-2 flex-wrap sm:gap-6">
                                @foreach($breeds as $breed)
                                    <x-forms.checkbox
                                        :name="'breeds[]'"
                                        :value="$breed->id"
                                        :label="$breed->name"
                                    />
                                @endforeach
                            </div>
                        </fieldset>
                    </div>

                    <div class="flex flex-col gap-8 lg:grid lg:grid-cols-2 lg:gap-x-16">
                        <div class="flex flex-col gap-8 sm:grid grid-cols-2 sm:gap-x-2">
                            <fieldset class="flex flex-col gap-4">
                                <legend>{{ __('admin/animals/index.sexe') }}</legend>
                                <div class="flex flex-row gap-2 flex-wrap sm:gap-6">
                                    @foreach(SexeAnimal::cases() as $sexe)
                                        <x-forms.checkbox
                                            :name="'sexes[]'"
                                            :value="$sexe->value"
                                            :label="$sexe->label()"
                                        />
                                    @endforeach
                                </div>
                            </fieldset>

                            <fieldset class="flex flex-col gap-4">
                                <legend>{{ __('admin/animals/index.age') }}</legend>

                                @php
                                    $ageTranches = ["0-4", "5-9", "10-14", "15-20"];
                                @endphp

                                <x-forms.select name="age_range" :options="$ageTranches"
                                                :disabled="__('admin/animals/index.disabled_age')"/>

                            </fieldset>


                        </div>

                        <fieldset class="flex flex-col gap-4">
                            <legend>{{ __('admin/animals/index.coat') }}</legend>
                            <div class="flex flex-row gap-2 flex-wrap sm:gap-6">
                                @foreach($coats as $coat)
                                    <x-forms.checkbox
                                        :name="'coats[]'"
                                        :value="$coat->id"
                                        :label="$coat->name"
                                    />
                                @endforeach
                            </div>
                        </fieldset>
                    </div>

                    <div class="flex flex-col gap-8 lg:grid lg:grid-cols-2 lg:gap-x-16">
                        <fieldset class="flex flex-col gap-4">
                            <legend>{{ __('admin/animals/index.behavior') }}</legend>
                            <div class="flex flex-row gap-2 flex-wrap sm:gap-6">
                                @foreach($behaviors as $behavior)
                                    <x-forms.checkbox
                                        :name="'behaviors[]'"
                                        :value="$behavior->id"
                                        :label="$behavior->name"
                                    />
                                @endforeach
                            </div>
                        </fieldset>

                        <fieldset class="flex flex-col gap-4">
                            <legend>{{ __('admin/animals/index.accept') }}</legend>
                            <div class="flex flex-row gap-2 flex-wrap sm:gap-6">
                                <x-forms.checkbox name="accept_cats" value="1" label="Chats"></x-forms.checkbox>
                                <x-forms.checkbox name="accept_dogs" value="1" label="Chiens"></x-forms.checkbox>
                                <x-forms.checkbox name="accept_kids" value="1" label="Enfants"></x-forms.checkbox>
                            </div>
                        </fieldset>
                    </div>

                    <x-forms.submit>
                        {{ __('admin/animals/index.submit_filter') }}
                    </x-forms.submit>

                </form>
            </div>
            <ul class="flex justify-center items-center mx-auto flex-row flex-wrap w-full gap-12 md:grid md:grid-cols-12 md:gap-x-12 md:gap-y-12  md:items-stretch">
                @foreach($animals as $animal)
                    <x-cards.animal-card :img_src="$animal->avatar"
                                         :name="$animal->name"
                                         :breed="$animal->breed->name"
                                         :sexe="$animal->sexe"
                                         :age="$animal->age . ' ans'"
                                         :behaviors="$animal->behaviors"
                                         :animal="$animal->id">
                    </x-cards.animal-card>
                @endforeach


            </ul>
        </div>

    </x-layouts.grid>

</x-layouts.section>
