@php
    $adoptionSteps = __('client/home/adoptions/adoptions.steps');
    $adoptionImages = [
    'searching' => [
        'src' => asset('img/800x800/adoption-step1.jpg'),
        'src_480x480' => asset('img/480x480/adoption-step1.jpg'),
        'src_600x600' => asset('img/600x600/adoption-step1.jpg'),
        'alt' => 'Un homme et une femme qui cherche une information sur leur ordinateur'
    ],
    'form' => [
        'src' => asset('img/800x800/adoption-step2.jpg'),
        'src_480x480' => asset('img/480x480/adoption-step2.jpg'),
        'src_600x600' => asset('img/600x600/adoption-step2.jpg'),
        'alt' => 'Un homme et une femme qui cherche une information sur leur ordinateur'
    ],
    'contact' => [
        'src' => asset('img/800x800/adoption-step3.jpg'),
        'src_480x480' => asset('img/480x480/adoption-step3.jpg'),
        'src_600x600' => asset('img/600x600/adoption-step3.jpg'),
        'alt' => 'Une femme au téléphone'
    ],
    'meeting' => [
        'src' => asset('img/800x800/adoption-step4.jpg'),
        'src_480x480' => asset('img/480x480/adoption-step4.jpg'),
        'src_600x600' => asset('img/600x600/adoption-step4.jpg'),
        'alt' => 'Un homme et chien qui se font un top-la'
    ],
    'finish' => [
        'src' => asset('img/800x800/adoption-step5.jpg'),
        'src_480x480' => asset('img/480x480/adoption-step5.jpg'),
        'src_600x600' => asset('img/600x600/adoption-step5.jpg'),
        'alt' => 'Un golden retriever qui fait une balade avec son maitre'
    ],
];
@endphp

<x-layouts.section :py="'basic'" :bg="'paws'">
    <x-layouts.grid class="gap-8">
        <h2 class="h2-section md:col-span-full md:row-auto">
            {!! __('client/home/adoptions/adoptions.title') !!}
        </h2>
        <ol class="md:row-auto flex flex-col gap-14 lg:gap-40 md:col-span-full">
            @foreach($adoptionSteps as $key => $step)
                <li class="item-adoption ">
                    <x-layouts.article
                            :title="$step['title']"
                            :paragraph="$step['content']"
                            :cta_href="isset($step['cta_href']) ? $step['cta_href'] : null"
                            :cta_title="isset($step['cta_title']) ? $step['cta_title'] : null"
                            :cta="isset($step['cta_text']) ? $step['cta_text'] : null"
                            :img_src="$adoptionImages[$key]['src']"
                            :img_src_480x480="$adoptionImages[$key]['src_480x480']"
                            :img_src_600x600="$adoptionImages[$key]['src_600x600']"
                            :img_alt="$adoptionImages[$key]['alt']"
                    />
                </li>

            @endforeach

        </ol>

    </x-layouts.grid>

</x-layouts.section>

{{--
    <div class="max-w-[1200px] m-auto px-8 flex flex-col gap-12">
--}}
