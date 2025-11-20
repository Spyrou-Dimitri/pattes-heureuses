<x-basics.section :py="'basic'" :bg="'paws'">
    <div class="max-w-[1200px] m-auto px-8 flex flex-col gap-4">

        <h2 class="h2-section">
            {{__('client/animals/index/landing.other-results')}}
        </h2>
        <ul class="flex justify-center items-center mx-auto flex-row flex-wrap w-full gap-12 md:grid md:grid-cols-3 md:gap-x-12 md:gap-y-12  md:items-stretch">

            @for($i = 0 ; $i < 3 ; $i++)
                <x-basics.animal-card :img_src="asset('img/animal/Jean.jpeg')"
                                      :img_alt="'test'"
                                      :title="'Jean'"
                                      :breed="'Golden retriever'"
                                      :sexe="'male'"
                                      :year="'2 ans'"
                                      :behaviors="['Sociable', 'Calme', 'Malicieux', 'Minotaure']"
                                      :adopt_me="'Adoptez-moi'">
                </x-basics.animal-card>
            @endfor
        </ul>
    </div>
</x-basics.section>
