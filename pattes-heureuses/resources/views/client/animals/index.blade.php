<x-layouts.auth>
    <x-client.sections.animals.index.section-landing :title="__('client/animals/index/landing.title')"
                                                     :paragraph="__('client/animals/index/landing.content')"
                                                     :img_src="asset('img/chien-loupe.png')"
                                                     :img_alt="__('client/animals/index/landing.img_alt')"
                                                     :filter_href="'#'"
                                                     :filter="__('client/animals/index/landing.filter')"
                                                     :filter_href_title="__('client/animals/index/landing.filter-title')"
    :animals="$animals" :all_species="$all_species" :all_behaviors="$all_behaviors" :all_coats="$all_coats" :all_breeds="$all_breeds">


    </x-client.sections.animals.index.section-landing>
</x-layouts.auth>


