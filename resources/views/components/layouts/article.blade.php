@props(
    [
        'level_title' => '',
        'title',
        'paragraph',
        'img_src',
        'img_src_480x480',
        'img_src_600x600',
        'img_alt',
        'cta' => false,
        'cta_href' => null,
        'cta_href_title' => null,
        'address' => false


]
)

<article class="flex flex-col gap-4 md:grid md:grid-cols-12 md:items-center md:gap-12">
    <div class="flex flex-col gap-4 items-start md:gap-6 md:col-span-6">
        <h3 class="h3-article">
            {!! $title !!}
        </h3>
        <p class="font-poppins">
            {{$paragraph}}
        </p>
        @if($cta)
            <x-basics.cta :href="$cta_href"
                          :title="$cta_href_title">
                {{$cta}}
            </x-basics.cta>

        @endif
        @if($address)
            <a href="#" class="underline hover:text-orange-cta duration-300">{{$address}}</a>
        @endif
    </div>
    <div class="md:col-span-6">
        <picture>
            <source media="(min-width:768px)"
                    srcset="{{asset($img_src_480x480)}}">
            <source media="(min-width:576px)"
                    srcset="{{asset($img_src_600x600)}}">
            <source media="(max-width:575px)"
                    srcset="{{asset($img_src_480x480)}}">
            <img src="{{$img_src}}"
                 alt="{{$img_alt}}"
                 class="w-full h-auto block shadow-main-blue-lg object-cover rounded-lg">
        </picture>
    </div>
</article>

