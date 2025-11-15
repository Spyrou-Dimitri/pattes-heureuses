@props(
    [
        'title',
        'paragraph',
        'img_src',
        'img_alt',
        'cta' => false,
        'cta_href' => null,
        'cta_href_title' => null


]
)

<div class="flex flex-col gap-4 items-start md:gap-6">
    <h2 class="h2-landing">
        {!! $title !!}
    </h2>
    <p class="font-poppins text-xl md:w-4/5">
        {{$paragraph}}
    </p>
    <x-basics.cta :href="$cta_href"
                  :title="$cta_href_title.' '.$cta">
        {{$cta}}
    </x-basics.cta>

</div>

<div>
    <img src="{{$img_src}}" alt="{{$img_alt}}"
         class="w-full h-auto block aspect-auto object-cover rounded-lg">
</div>
