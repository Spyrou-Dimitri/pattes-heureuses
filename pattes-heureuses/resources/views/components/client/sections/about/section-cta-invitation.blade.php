<x-basics.section :bg="'paws'">
    <div class="relative mx-8 max-w-[1200px] p-8 flex flex-col justify-center items-center bg-main-blue rounded-lg lg:grid lg:grid-cols-2 lg:p-16 xl:mx-auto">
        <div class="flex flex-col gap-4 items-center lg:items-start lg:gap-6">
            <h2 class="h2-section  text-center text-white">
                {{__('client/about/cta-invitation/cta-invitation.title')}}
            </h2>
            <p class="font-poppins text-center text-white lg:text-left">
                {{__('client/about/cta-invitation/cta-invitation.content')}}

            </p>
            <x-basics.cta :href="route('animals')" :title="__('client/home/cta-invitation/cta-invitation.cta-title')">
                {{__('client/about/cta-invitation/cta-invitation.cta')}}
            </x-basics.cta>
        </div>

        <div class="hidden lg:block lg:absolute lg:right-1/12 lg:bottom-[-70px] lg:w-full lg: max-w-[450px]">
            <img src="{{asset('img/chatBureau-cta-contact.png')}}" alt="{{__('client/about/cta-invitation/cta-invitation.alt')}}">
        </div>

    </div>
</x-basics.section>
