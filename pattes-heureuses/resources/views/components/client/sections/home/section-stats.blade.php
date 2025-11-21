<x-basics.section :py="'basic'" :bg="'gray'">
    <x-basics.grid class="md:gap-y-6">
        <div class="flex flex-col gap-3 items-start md:col-span-full">
            <h2 class="h2-section mx-auto">
                {!! __('client/home/stats/stats.title') !!}
            </h2>
            <p class="font-poppins text-center mx-auto text-xl md:w-4/5">
                {{__('client/home/stats/stats.content')}}
            </p>
        </div>
        <ul class="md:col-span-full flex items-center mx-auto flex-col w-full gap-12 md:grid md:grid-cols-12 md:items-stretch">
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
    </x-basics.grid>
</x-basics.section>

{{--
    <div class="max-w-[1200px] m-auto px-8 flex flex-col gap-12 justify-center items-center">

--}}
