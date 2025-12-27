@php
    $faq_categories = __('client/home/faq/faq.categories');
@endphp

<x-layouts.section :py="'basic'" :bg="'gray'">
    <x-layouts.grid class="md:items-baseline">
        <div class="flex flex-col gap-4 items-start  md:items-baseline md:sticky md:top-10 md:col-span-6">
            <h2 class="h2-section">
                {!! __('client/home/faq/faq.title')  !!}
            </h2>
            <div class="flex flex-col gap-8">
                <p class="font-poppins">
                    {{__('client/home/faq/faq.content')}}
                </p>
                <p class="font-poppins">
                    {{__('client/home/faq/faq.content-next')}}
                </p>
            </div>
            <x-basics.cta :href="route('contact.create')" :title="__('client/home/faq/faq.cta-title'). ' ' .'contact'">
                {{__('client/home/faq/faq.cta')}}
            </x-basics.cta>
            <div class="hidden md:block md:w-4/5 md:mx-auto">
                <picture>
                    <source media="(min-width:1000px)" srcset="{!! asset('img/600x600/dog-faq.png') !!}">
                    <source media="(min-width:768px)" srcset="{!! asset('img/480x480/dog-faq.png') !!}">
                    <source media="(min-width:530px)" srcset="{!! asset('img/800x800/dog-faq.png') !!}">
                    <source media="(max-width:529px)" srcset="{!! asset('img/480x480/dog-faq.png') !!}">
                </picture>

                <img src="{!! asset('img/600x600/dog-faq.png') !!}" alt="{{__('client/home/faq/faq.alt')}}"
                     class="w-full h-auto block aspect-auto object-cover rounded-lg">
            </div>
        </div>
        <div class="flex flex-col gap-12 md:col-span-6 ">
            @foreach($faq_categories as $category_key => $category)
                @php
                    $questions_list = $category['faq'];
                @endphp
                <section class="flex flex-col gap-4">
                    <h3 class="h3-article">
                        {{$category['title']}}
                    </h3>
                    <div class="flex flex-col gap-8">
                        @foreach($questions_list as $faqs => $faq)
                            <x-layouts.question-answer :question="$faq['question']" :answer="$faq['answer']"/>
                        @endforeach
                    </div>

                </section>
            @endforeach
        </div>

    </x-layouts.grid>
</x-layouts.section>

{{--
    <div class="relative max-w-[1200px] m-auto px-8 flex flex-col gap-12 justify-center items-center md:grid md:grid-cols-2 md:items-baseline">

--}}



