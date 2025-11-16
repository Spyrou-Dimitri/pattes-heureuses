<x-basics.section :py="'basic'" :bg="'gray'">
    <div class="max-w-[1200px] m-auto px-8 flex flex-col gap-12 justify-center items-center">
        <div class="flex flex-col gap-3 items-start">
            <h2 class="h2-section mx-auto">
                {!! __('client/about/team/team.title') !!}
            </h2>
            <p class="font-poppins text-center mx-auto text-xl md:w-4/5">
                {{__('client/about/team/team.content')}}
            </p>
        </div>
        <ul class="flex justify-center items-center mx-auto flex-row flex-wrap w-full gap-12  md:justify-between md:gap-12 md:items-stretch">
            @for($i = 0; $i < 4; $i++)
                <x-basics.team-card :img_src="asset('img/personnel/moi.jpg')"
                                    :img_alt="'Photo de moi'"
                                    :title="'Dimitri Spyrou'"
                                    :role="'Dieu du front'">

                </x-basics.team-card>
            @endfor
        </ul>
    </div>
</x-basics.section>

