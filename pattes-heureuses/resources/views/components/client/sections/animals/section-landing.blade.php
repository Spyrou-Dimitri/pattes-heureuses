@props(
    [
        'title',
        'paragraph',
        'img_src',
        'img_alt',
        'filter' => false,
        'filter_href'=> null,
        'filter_href_title' => null,
        'search' => false,
        'cta' => false,
        'cta_href' => null,
        'cta_href_title' => null
]
)

<x-basics.section :py="'landing'" :bg="'paws'">
    <div class="max-w-[1200px] m-auto px-8 flex flex-col gap-4 md:grid md:grid-cols-2 md:items-center">
        <div class="flex flex-col gap-4 items-start md:gap-6">
            <h2 class="h2-landing">
                {!! $title !!}
            </h2>
            <p class="font-poppins">
                {{$paragraph}}
            </p>
            <x-basics.input :type="'search'"
                            :name="'search-bar'"
                            :label="__('client/animals/index/landing.search-bar-label')"
                            :placeholder="__('client/animals/index/landing.search-bar-placerholder')">

            </x-basics.input>
            <x-basics.cta :href="$filter_href"
                          :title="$filter_href_title">
                {{$filter}}
            </x-basics.cta>


        </div>
        <div class="hidden md:block">
            <img src="{{$img_src}}" alt="{{$img_alt}}"
                 class="w-full h-auto block aspect-auto object-cover rounded-lg">
        </div>
    </div>
</x-basics.section>
<x-basics.section :py="'basic'" :bg="'paws'" class="md:col-span-2">
    <div class="max-w-[1200px] m-auto px-8 flex flex-col gap-4">

        <h2 class="h2-section">
            {{__('client/animals/index/landing.Result')}} (4)
        </h2>
        <ul class="flex justify-center items-center mx-auto flex-row flex-wrap w-full gap-12 md:grid md:grid-cols-3 md:gap-x-12 md:gap-y-12  md:items-stretch">
            @for($i = 0 ; $i < 4 ; $i++)
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

