@php

    $stats = [
        [
            'title' => __('client/home/stats/stats.card-adoption-title'),
            'value' => '39',
            'icon' => 'hearth',
        ],
        [
            'title' => __('client/home/stats/stats.card-benevole-title'),
            'value' => '48',
            'icon' => 'benevole',
        ],
        [
            'title' => __('client/home/stats/stats.card-animals-title'),
            'value' => '29',
            'icon' => 'paws',
        ],
        [
            'title' => __('client/home/stats/stats.card-dispo-title'),
            'value' => '19',
            'icon' => 'house',
        ]
    ];
@endphp

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
            @foreach($stats as $stat)
                <x-cards.stat-card :title="$stat['title']"
                                   :number="$stat['value']"
                                   :icons="$stat['icon']">

                </x-cards.stat-card>
            @endforeach

        </ul>
    </x-layouts.grid>
</x-layouts.section>


