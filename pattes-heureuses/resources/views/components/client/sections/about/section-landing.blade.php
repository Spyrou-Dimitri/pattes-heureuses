<x-layouts.section :py="'basic'" :bg="'paws'">
    <x-layouts.grid>

        <x-layouts.landing
                :title="__('client/about/landing/landing.title')"
                :paragraph="__('client/about/landing/landing.content')"
                :cta="__('client/about/landing/landing.cta')"
                :cta_href="route('about')"
                :cta_href_title="__('client/about/landing/landing.title-cta')"
                :img_src="asset('img/refugeAnimalier.jpeg')"
                :img_alt="__('client/about/landing/landing.img-alt')">

        </x-layouts.landing>

    </x-layouts.grid>

</x-layouts.section>
