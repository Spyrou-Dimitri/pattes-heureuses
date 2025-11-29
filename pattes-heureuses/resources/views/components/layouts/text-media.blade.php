@props(
    [
        'title',
        'level_title' =>'',
        'paragraph',
        'img_src_480',
        'img_src_600',
        'img_src_800',
        'img_alt',
        'cta' => false,
        'cta_href' => null,
        'cta_href_title' => null,
        'adresse' => false,
        'filters' => false,

        ]
)

@php

    $levels_titles_variants = [
        'h2-landing' => 'h2-landing',
        'h2-section' => 'h2-section',
        'h3'=> 'h3-article'
   ];

   $level_title = $levels_titles_variants[$level_title]  ?? $levels_titles_variants['h2-section']


@endphp
<div class="flex flex-col gap-4 items-start md:gap-6 md:col-span-6">
    @if($level_title === 'h2-landing')
        <h2 class="h2-landing">
            {!! $title !!}
        </h2>
    @elseif($level_title === 'h2-section')
        <h2 class="h2-section">
            {!! $title !!}
        </h2>
    @else
        <h3 class="h3-article">
            {!! $title !!}

        </h3>
    @endif

    <p class="font-poppins">
        {{$paragraph}}
    </p>
    @if($filters)
        <div class="flex items-stretch justify-between gap-4">
            <x-forms.input :type="'search'"
                           :name="'search-bar'"
                           :label="__('client/animals/index/landing.search-bar-label')"
                           :placeholder="__('client/animals/index/landing.search-bar-placeholder')">

            </x-forms.input>
            <x-basics.cta>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="25px" height="25px">
                    <g stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="3">
                        <path d="M10 17a7 7 0 1 0 0-14 7 7 0 0 0 0 14ZM21 21l-6.05-6.05"/>
                    </g>
                </svg>
            </x-basics.cta>
            <a href="">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="20" height="20" viewBox="0 0 24 24">
                    <path stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 4.6c0-.56 0-.84.109-1.054a1 1 0 0 1 .437-.437C3.76 3 4.04 3 4.6 3h14.8c.56 0 .84 0 1.054.109a1 1 0 0 1 .437.437C21 3.76 21 4.04 21 4.6v1.737c0 .245 0 .367-.028.482a.998.998 0 0 1-.12.29c-.061.1-.148.187-.32.36l-6.063 6.062c-.173.173-.26.26-.322.36a.998.998 0 0 0-.12.29c-.027.115-.027.237-.027.482V17l-4 4v-6.337c0-.245 0-.367-.028-.482a1 1 0 0 0-.12-.29c-.061-.1-.148-.187-.32-.36L3.468 7.47c-.173-.173-.26-.26-.322-.36a1 1 0 0 1-.12-.29C3 6.704 3 6.582 3 6.337V4.6Z"/>
                </svg>
                <span>
                    Filtres
                </span>
            </a>
        </div>
        <x-basics.cta :href="$cta_href"
                      :title="$cta_href_title"
                      class="flex">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 4.6c0-.56 0-.84.109-1.054a1 1 0 0 1 .437-.437C3.76 3 4.04 3 4.6 3h14.8c.56 0 .84 0 1.054.109a1 1 0 0 1 .437.437C21 3.76 21 4.04 21 4.6v1.737c0 .245 0 .367-.028.482a.998.998 0 0 1-.12.29c-.061.1-.148.187-.32.36l-6.063 6.062c-.173.173-.26.26-.322.36a.998.998 0 0 0-.12.29c-.027.115-.027.237-.027.482V17l-4 4v-6.337c0-.245 0-.367-.028-.482a1 1 0 0 0-.12-.29c-.061-.1-.148-.187-.32-.36L3.468 7.47c-.173-.173-.26-.26-.322-.36a1 1 0 0 1-.12-.29C3 6.704 3 6.582 3 6.337V4.6Z"/>
            </svg>
            {{$cta}}
        </x-basics.cta>
    @endif
    @if($cta && $filters === false)
        <x-basics.cta :href="$cta_href"
                      :title="$cta_href_title">
            {{$cta}}
        </x-basics.cta>
    @endif

</div>
<div class="md:col-span-6">
    <picture>
        <source media="(min-width:1000px)" srcset="{!! $img_src_600 !!}">
        <source media="(min-width:768px)" srcset="{!! $img_src_480 !!}">
        <source media="(min-width:530px)" srcset="{!! $img_src_800 !!}">
        <source media="(max-width:529px)" srcset="{!! $img_src_480 !!}">
    </picture>

    <img src="{{$img_src_600}}" alt="{{$img_alt}}"
         class="w-full h-auto block aspect-auto object-cover rounded-lg">
</div>
