@props(
    [
        'level_title' => '',
        'title',
        'paragraph',
        'img_src',
        'img_alt',
        'cta' => false,
        'cta_href' => null,
        'cta_href_title' => null,
        'address' => false


]
)
 <article class="flex flex-col gap-4 md:grid md:grid-cols-2 md:items-center md:gap-12">
    <div class="flex flex-col gap-4 items-start md:gap-6">
        <h3 class="h3-article">
            {!! $title !!}
        </h3>
        <p class="font-poppins">
            {{$paragraph}}
        </p>
        @if($cta)
            <x-basics.cta :href="$cta_href"
                          :title="$cta_href_title.' '.$cta">
                {{$cta}}
            </x-basics.cta>

        @endif
        @if($address)
            <a href="#" class="underline hover:text-orange-cta duration-300">{{$address}}</a>
        @endif
    </div>
    <div class="">
        <img src="{{$img_src}}" alt="{{$img_alt}}"
             class="w-full h-auto block aspect-auto object-cover rounded-lg border-1 border-main-blue shadow-main-blue-lg">
    </div>
</article>
