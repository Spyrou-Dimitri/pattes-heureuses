@php
    $adoptionSteps = __('client/home/adoptions/adoptions.steps');
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
                            :img_src="isset($step['src']) ? $step['src'] : asset('img/adoptions/step1.jpg')"
                            :img_alt="isset($step['alt']) ? $step['alt'] : ''"
                    />
                </li>

            @endforeach

        </ol>

    </x-layouts.grid>

</x-layouts.section>

{{--
    <div class="max-w-[1200px] m-auto px-8 flex flex-col gap-12">
--}}
