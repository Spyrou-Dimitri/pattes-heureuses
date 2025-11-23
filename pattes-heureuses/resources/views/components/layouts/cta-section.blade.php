@props([
'title',
'paragraph',
'href_cta',
'href_cta_title',
'cta',
'img_src_480',
'img_src_600',
'img_src_800',
'img_alt'
])

<div class="relative mx-8 max-w-[1200px] p-8 flex flex-col justify-center items-center bg-main-blue rounded-lg lg:grid lg:grid-cols-2 lg:p-16 xl:mx-auto">
    <div class="flex flex-col gap-4 items-center lg:items-start lg:gap-6">
        <h2 class="h2-section  text-center text-white">
            {{$title}}
        </h2>
        <p class="font-poppins text-center text-white lg:text-left">
            {{$paragraph}}
        </p>
        <x-basics.cta :href="$href_cta" :title="$href_cta_title">
            {{$cta}}
        </x-basics.cta>
    </div>
    <div class="hidden lg:block lg:absolute lg:right-1/12 lg:bottom-[-47px] lg:w-full lg: max-w-[450px]">
        <picture>
            <source media="(min-width:1000px)" srcset="{!! $img_src_600 !!}">
            <source media="(min-width:768px)" srcset="{!! $img_src_480 !!}">
            <source media="(min-width:530px)" srcset="{!! $img_src_800 !!}">
            <source media="(max-width:529px)" srcset="{!! $img_src_480 !!}">
        </picture>

        <img src="{{$img_src_600}}" alt="{{$img_alt}}"
             class="w-full h-auto block aspect-auto object-cover rounded-lg">
    </div>

</div>
