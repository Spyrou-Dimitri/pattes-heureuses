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
        'cta_href_title' => null,
        'animals',
        'all_species',
        'all_coats',
        'all_behaviors',
        'all_breeds',
]
)

<x-layouts.section :py="'landing'" :bg="'paws'">
    <x-layouts.grid class="md:items-center">
        <x-layouts.text-media :title="__('client/animals/index/landing.title')"
                              :level_title="'h2-landing'"
                              :paragraph="__('client/animals/index/landing.content')"
                              :img_src_480="asset('img/400x400/animal-index-landing.png')"
                              :img_src_600="asset('img/600x600/animal-index-landing.png')"
                              :img_src_800="asset('img/800x800/animal-index-landing.png')"
                              :img_alt="__('client/animals/index/landing.img_alt')"
                              >

        </x-layouts.text-media>
        <div class="md:gap-6 md:col-span-full">
            <x-client.sections.animals.index.section-results :animals="$animals" :species="$all_species" :breeds="$all_breeds" :coats="$all_coats" :behaviors="$all_behaviors"/>

        </div>

    </x-layouts.grid>

</x-layouts.section>


