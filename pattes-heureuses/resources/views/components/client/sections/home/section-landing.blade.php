<x-layouts.section :py="'landing'" :bg="'paws'">
    <x-layouts.grid class="md:items-center">
        <x-layouts.text-media
            :level_title="'h2-landing'"
            :title="__('client/home/landing/landing.title')"
            :paragraph="__('client/home/landing/landing.content')"
            :cta="__('client/home/landing/landing.cta')"
            :cta_href="route('about')"
            :cta_href_title="__('client/home/landing/landing.title-cta')"
            :img_src_480="asset('img/480x480/TrioLanding.png')"
            :img_src_600="asset('img/600x600/TrioLanding.png')"
            :img_src_800="asset('img/480x480/TrioLanding.png')"
            :img_alt="'Un golden retriever, un chat noir et un border collie'">


        </x-layouts.text-media>

    </x-layouts.grid>


</x-layouts.section>
