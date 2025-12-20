@props([
    'animals'
    ])

<x-layouts.section :py="'basic'" :bg="'paws'" class="md:col-span-2">
    <x-layouts.grid class="md:gap-4">
        <h2 class="h2-section md:col-span-full">
            {{__('client/animals/index/landing.Result')}} ({{$animals->count()}})
        </h2>
        <ul class=" md:col-span-12 flex justify-center items-center mx-auto flex-row flex-wrap w-full gap-12 md:grid md:grid-cols-12 md:gap-x-12 md:gap-y-12  md:items-stretch">
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
    </x-layouts.grid>

</x-layouts.section>
