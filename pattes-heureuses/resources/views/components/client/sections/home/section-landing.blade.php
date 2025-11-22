<x-layouts.section :py="'landing'" :bg="'paws'">
    <x-layouts.grid class="md:items-center">
        <x-layouts.landing
            :title="__('client/home/landing/landing.title')"
            :paragraph="__('client/home/landing/landing.content')"
            :cta="__('client/home/landing/landing.cta')"
            :cta_href="route('about')"
            :cta_href_title="__('client/home/landing/landing.title-cta')"
            :img_src="asset('img/TrioLanding.png')"
            :img_alt="__('client/img-alt.trio-landing')">

        </x-layouts.landing>
        `
    </x-layouts.grid>


</x-layouts.section>
