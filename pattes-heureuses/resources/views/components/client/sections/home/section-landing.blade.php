<x-basics.section :py="'landing'" :bg="'paws'">
    <x-basics.grid class="md:items-center">
        <x-layouts.auth.landing
            :title="__('client/home/landing/landing.title')"
            :paragraph="__('client/home/landing/landing.content')"
            :cta="__('client/home/landing/landing.cta')"
            :cta_href="route('about')"
            :cta_href_title="__('client/home/landing/landing.title-cta')"
            :img_src="asset('img/TrioLanding.png')"
            :img_alt="__('client/img-alt.trio-landing')">

        </x-layouts.auth.landing>
        `
    </x-basics.grid>


</x-basics.section>
{{--<div class="max-w-[1200px] m-auto px-8 flex flex-col gap-4 md:grid md:grid-cols-2 md:items-center">--}}
