<x-layouts.section :py="'basic'" :bg="'gray'">
    <x-layouts.grid class="md:gap-y-6">
        <div class="flex flex-col gap-3 items-start md:col-span-full">
            <h2 class="h2-section mx-auto">
                {!! __('client/home/stats/stats.title') !!}
            </h2>
            <p class="font-poppins text-center mx-auto text-xl md:w-4/5">
                {{__('client/home/stats/stats.content')}}
            </p>
        </div>
        <ul class="md:col-span-full flex items-center mx-auto flex-col w-full gap-12 md:grid md:grid-cols-12 md:items-stretch">
            <x-cards.stat-card :title="__('client/home/stats/stats.card-adoption-title')"
                         :number="'39'"
                         :icons="'hearth'">

            </x-cards.stat-card>
            <x-cards.stat-card :title="__('client/home/stats/stats.card-benevole-title')"
                         :number="'48'"
                         :icons="'benevole'">

            </x-cards.stat-card>
            <x-cards.stat-card :title="__('client/home/stats/stats.card-animals-title')"
                         :number="'29'"
                         :icons="'paws'">

            </x-cards.stat-card>
            <x-cards.stat-card :title="__('client/home/stats/stats.card-dispo-title')"
                         :number="'19'"
                         :icons="'house'">

            </x-cards.stat-card>
        </ul>
    </x-layouts.grid>
</x-layouts.section>

{{--
    <div class="max-w-[1200px] m-auto px-8 flex flex-col gap-12 justify-center items-center">

--}}
