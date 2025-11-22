@props(
    [
        'level_title' => '',
        'title',
        'paragraph',
        'img_src',
        'img_alt',
        'cta' => false,
        'cta_href' => null,
        'cta_href_title' => null


]
)


@php


    $levels_titles_variants = [
        'h2' => 'h2-section',
        'h3'=> 'h3-article'
   ];

   $level_title = $levels_titles_variants[$level_title]  ?? $levels_titles_variants['h2']


@endphp

@if($level_title === $levels_titles_variants['h3'])
        <article class="flex flex-col lg:grid lg:grid-cols-2 lg:items-center lg:gap-6">
            <div class="flex flex-col gap-4 items-start md:gap-6">
                <h3 class="{{$level_title}}">
                    {!! $title !!}
                </h3>
                <p class="font-poppins md:w-4/5">
                    {{$paragraph}}
                </p>
                @if($cta)
                    <x-basics.cta :href="$cta_href"
                                  :title="$cta_href_title.' '.$cta">
                        {{$cta}}
                    </x-basics.cta>

                @endif
            </div>
            <div>
                <img src="{{$img_src}}" alt="{{$img_alt}}"
                     class="w-full h-auto block aspect-auto object-cover rounded-lg border-1 border-main-blue shadow-main-blue-lg">
            </div>
        </article>


@else

    <div class="flex flex-col gap-4 items-start md:gap-6">

        <h2 class="{{$level_title}}">
            {!! $title !!}
        </h2>
        <p class="font-poppins text-xl md:w-4/5">
            {{$paragraph}}
        </p>
        @if($cta)
            <x-basics.cta :href="$cta_href"
                          :title="$cta_href_title.' '.$cta">
                {{$cta}}
            </x-basics.cta>

        @endif
        @endif
    </div>

