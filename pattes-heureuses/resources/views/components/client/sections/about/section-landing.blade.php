<x-layouts.section :py="'basic'" :bg="'paws'">
    <x-layouts.grid class="items-center">

        <x-layouts.text-media
                :title="__('client/about/landing/landing.title')"
                :level_title="'h2-landing'"
                :paragraph="__('client/about/landing/landing.content')"
                :cta="__('client/about/landing/landing.cta')"
                :cta_href="route('about')"
                :cta_href_title="__('client/about/landing/landing.title-cta')"
                :img_src_480="asset('img/480x480/about-landing.jpg')"
                :img_src_600="asset('img/600x600/about-landing.jpg')"
                :img_src_800="asset('img/800x800/about-landing.jpg')"
                :img_alt="__('client/about/landing/landing.img-alt')">

        </x-layouts.text-media>

    </x-layouts.grid>

</x-layouts.section>
