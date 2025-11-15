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
 <article class="flex flex-col gap-4 lg:grid lg:grid-cols-2 lg:items-center lg:gap-12">
    <div class="flex flex-col gap-4 items-start lg:gap-6">
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
    </div>
    <div class="">
        <img src="{{$img_src}}" alt="{{$img_alt}}"
             class="w-full h-auto block aspect-auto object-cover rounded-lg border-1 border-main-blue shadow-main-blue-lg">
    </div>
</article>
