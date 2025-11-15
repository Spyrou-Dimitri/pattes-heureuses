<x-basics.section :bg="'gray'">
    <div class="max-w-[1200px] m-auto px-8 flex flex-col gap-4 justify-center items-center md:gap-8">
        <div class="flex flex-col gap-4 items-start md:gap-6">
            <h2 class="font-fredoka text-5xl font-semibold leading-16 text-center w-full">
                {!! __('client/home/stats/stats.title') !!}
            </h2>
            <p class="font-poppins text-center mx-auto text-xl md:w-4/5">
                {{__('client/home/stats/stats.content')}}
            </p>
        </div>
        <ul class="flex items-center mx-auto flex-col w-full gap-4 md:flex-row md:justify-between md:gap-10 md:items-stretch">
            <x-basics.stat-card :title="__('client/home/stats/stats.card-adoption-title')"
                         :number="'39'"
                         :icons="'hearth'">

            </x-basics.stat-card>
            <x-basics.stat-card :title="__('client/home/stats/stats.card-benevole-title')"
                         :number="'48'"
                         :icons="'benevole'">

            </x-basics.stat-card>
            <x-basics.stat-card :title="__('client/home/stats/stats.card-animals-title')"
                         :number="'29'"
                         :icons="'paws'">

            </x-basics.stat-card>
            <x-basics.stat-card :title="__('client/home/stats/stats.card-dispo-title')"
                         :number="'19'"
                         :icons="'house'">

            </x-basics.stat-card>
        </ul>
    </div>
</x-basics.section>

