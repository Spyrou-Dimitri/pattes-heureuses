<x-basics.section :py="'basic'" :bg="'paws'">
    <x-basics.grid>

        <x-layouts.auth.landing
                :title="__('client/about/landing/landing.title')"
                :paragraph="__('client/about/landing/landing.content')"
                :cta="__('client/about/landing/landing.cta')"
                :cta_href="route('about')"
                :cta_href_title="__('client/about/landing/landing.title-cta')"
                :img_src="asset('img/refugeAnimalier.jpeg')"
                :img_alt="__('client/about/landing/landing.img-alt')">

        </x-layouts.auth.landing>

    </x-basics.grid>

</x-basics.section>
