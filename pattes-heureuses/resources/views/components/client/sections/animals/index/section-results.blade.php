<x-layouts.section :py="'basic'" :bg="'paws'" class="md:col-span-2">
    <x-layouts.grid class="md:gap-4">


        <h2 class="h2-section md:col-span-full">
            {{__('client/animals/index/landing.Result')}} (4)
        </h2>
        <ul class=" md:col-span-12 flex justify-center items-center mx-auto flex-row flex-wrap w-full gap-12 md:grid md:grid-cols-12 md:gap-x-12 md:gap-y-12  md:items-stretch">
            @for($i = 0 ; $i < 4 ; $i++)
                <x-cards.animal-card :img_src="asset('img/animal/Jean.jpeg')"
                                      :img_alt="'test'"
                                      :title="'Jean'"
                                      :breed="'Golden retriever'"
                                      :sexe="'male'"
                                      :year="'2 ans'"
                                      :behaviors="['Sociable', 'Calme', 'Malicieux', 'Minotaure']"
                                      :adopt_me="'Adoptez-moi'">
                </x-cards.animal-card>
            @endfor

        </ul>
    </x-layouts.grid>

</x-layouts.section>
