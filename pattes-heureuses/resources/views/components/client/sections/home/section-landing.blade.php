<x-basics.section :bg="'paws'">
    <div class="max-w-[1200px] m-auto px-8 flex flex-col gap-4 md:grid md:grid-cols-2 md:items-center">
        <div class="flex flex-col gap-4 items-start md:gap-6">
            <h2 class="font-fredoka text-5xl font-semibold leading-16">
                {!!  __('client/home/landing/landing.title')!!}
            </h2>
            <p class="font-poppins text-xl md:w-4/5">
                {{__('client/home/landing/landing.content')}}
            </p>
            <x-basics.cta :href="route('about')"
                          :title="__('client/home/landing/landing.title-cta').' '.__('client/home/landing/landing.cta')">
            {{__('client/home/landing/landing.cta')}}
            </x-basics.cta>
        </div>

        <div>
            <img src="{{asset('img/TrioLanding.png')}}" alt="{{__('client/img-alt.trio-landing')}}">
        </div>

    </div>

</x-basics.section>
