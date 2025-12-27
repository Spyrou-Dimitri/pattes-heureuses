@php use App\Enums\SexeAnimal; @endphp
@props([
    'animals',
    'species',
    'breeds',
    'coats',
    'behaviors',
    ])

<x-layouts.section :py="'basic'" :bg="'paws'" class="md:col-span-2">
    <x-layouts.grid class="md:gap-4">
        <h2 class="h2-section md:col-span-full">
            {{__('client/animals/index/landing.Result')}} ({{$animals->count()}})
        </h2>
        <div class="md:col-span-12">
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

                                <x-forms.select name="age_range" :options="$ageTranches" :disabled="__('admin/animals/index.disabled_age')"/>

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
            <ul class="  flex justify-center items-center mx-auto flex-row flex-wrap w-full gap-12 md:grid md:grid-cols-12 md:gap-x-12 md:gap-y-12  md:items-stretch">
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
