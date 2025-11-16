@php
    $storySteps = __('client/about/story/story.steps');
@endphp

<x-basics.section :py="'basic'" :bg="'paws'">
    <div class="max-w-[1200px] m-auto px-8 flex flex-col gap-12">
        <h2 class="h2-section">
            {!! __('client/home/adoptions/adoptions.title') !!}
        </h2>
        <ul class="flex flex-col gap-14 lg:gap-40">
            @foreach($storySteps as $key => $step)
                <li class="item-adoption">
                    <x-layouts.auth.article
                            :title="$step['title']"
                            :paragraph="$step['content']"
                            :cta_href="isset($step['cta_href']) ? $step['cta_href'] : null"
                            :cta_title="isset($step['cta_title']) ? $step['cta_title'] : null"
                            :address="isset($step['address']) ? $step['address'] : null"
                            :cta="isset($step['cta_text']) ? $step['cta_text'] : null"
                            :img_src="isset($step['src']) ? $step['src'] : asset('img/adoptions/step1.jpg')"
                            :img_alt="isset($step['alt']) ? $step['alt'] : ''"
                    />
                </li>

            @endforeach

        </ul>

    </div>

</x-basics.section>
