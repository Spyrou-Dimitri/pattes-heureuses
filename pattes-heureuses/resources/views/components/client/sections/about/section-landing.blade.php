<x-basics.section :py="'basic'" :bg="'paws'">
    <div class="max-w-[1200px] m-auto flex flex-col gap-4 lg:grid lg:grid-cols-2 lg:items-center lg:gap-12">
        <x-layouts.auth.landing
                :title="__('client/about/landing/landing.title')"
                :paragraph="__('client/about/landing/landing.content')"
                :cta="__('client/about/landing/landing.cta')"
                :cta_href="route('about')"
                :cta_href_title="__('client/about/landing/landing.title-cta')"
                :img_src="asset('img/refugeAnimalier.jpeg')"
                :img_alt="__('client/about/landing/landing.img-alt')">

        </x-layouts.auth.landing>

    </div>

</x-basics.section>
