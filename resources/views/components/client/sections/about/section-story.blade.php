@php
    $storySteps = __('client/about/story/story.steps');
    $storyImages = [
    'start' => [
        'src' => asset('img/800x800/story1.jpg'),
        'src_480x480' => asset('img/480x480/story1.jpg'),
        'src_600x600' => asset('img/600x600/story1.jpg'),
        'alt' => 'La façade du refuge Les Pattes Heureuses'
    ],
    'daily' => [
        'src' => asset('img/800x800/story2.jpg'),
        'src_480x480' => asset('img/480x480/story2.jpg'),
        'src_600x600' => asset('img/600x600/story2.jpg'),
        'alt' => 'Des bénévoles s\'occupant des animaux au refuge'
    ],
    'futur' => [
        'src' => asset('img/800x800/story3.jpg'),
        'src_480x480' => asset('img/480x480/story3.jpg'),
        'src_600x600' => asset('img/600x600/story3.jpg'),
        'alt' => 'Un animal adopté partant vers sa nouvelle famille'
    ],
];
@endphp

<x-layouts.section :py="'basic'" :bg="'paws'">
    <x-layouts.grid class="md:gap-8">

        <h2 class="h2-section md:col-span-full">
            {!! __('client/home/adoptions/adoptions.title') !!}
        </h2>
        <ul class="flex flex-col gap-14 lg:gap-40 col-span-full">
            @foreach($storySteps as $key => $step)
                <li class="item-adoption">
                    <x-layouts.article
                            :title="$step['title']"
                            :paragraph="$step['content']"
                            :cta_href="isset($step['cta_href']) ? $step['cta_href'] : null"
                            :cta_title="isset($step['cta_title']) ? $step['cta_title'] : null"
                            :address="isset($step['address']) ? $step['address'] : null"
                            :cta="isset($step['cta_text']) ? $step['cta_text'] : null"
                            :img_src="$storyImages[$key]['src']"
                            :img_src_480x480="$storyImages[$key]['src_480x480']"
                            :img_src_600x600="$storyImages[$key]['src_600x600']"
                            :img_alt="$storyImages[$key]['alt']"
                    />
                </li>

            @endforeach

        </ul>

    </x-layouts.grid>

</x-layouts.section>
