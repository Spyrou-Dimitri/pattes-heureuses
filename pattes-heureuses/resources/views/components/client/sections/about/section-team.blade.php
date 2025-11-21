<x-basics.section :py="'basic'" :bg="'gray'">
    <x-basics.grid>

        <div class="flex flex-col gap-3 items-start md:col-span-full">
            <h2 class="h2-section mx-auto">
                {!! __('client/about/team/team.title') !!}
            </h2>
            <p class="font-poppins text-center mx-auto text-xl md:w-4/5">
                {{__('client/about/team/team.content')}}
            </p>
        </div>
        <ul class="md:col-span-full flex justify-center items-center mx-auto flex-row flex-wrap w-full gap-12 md:grid md:grid-cols-12 md:gap-x-12 md:gap-y-4  md:items-stretch">
            @for($i = 0; $i < 8; $i++)
                <x-basics.team-card :img_src="asset('img/personnel/moi.jpg')"
                                    :img_alt="'Photo de moi'"
                                    :title="'Dimitri Spyrou'"
                                    :role="'Dieu du front'">
                </x-basics.team-card>
            @endfor
        </ul>
    </x-basics.grid>
</x-basics.section>

