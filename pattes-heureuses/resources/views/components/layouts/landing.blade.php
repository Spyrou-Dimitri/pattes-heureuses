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

<div class="flex flex-col gap-4 items-start md:gap-6 md:col-span-6">
    <h2 class="h2-landing">
        {!! $title !!}
    </h2>
    <p class="font-poppins">
        {{$paragraph}}
    </p>

    <x-basics.cta :href="$cta_href"
                  :title="$cta_href_title">
        {{$cta}}
    </x-basics.cta>

</div>
<div class="md:col-span-6">
    <picture>
        <source media="(min-width:1000px)" srcset="{{asset('img/600x600/TrioLanding.png')}}">
        <source media="(min-width:768px)" srcset="{{asset('img/480x6480/TrioLanding.png')}}">
        <source media="(min-width:530px)" srcset="{{asset('img/800x800/TrioLanding.png')}}">
        <source media="(max-width:529px)" srcset="{{asset('img/480x480/TrioLanding.png')}}">
    </picture>

    <img src="{{$img_src_600}}" alt="{{$img_alt}}"
         class="w-full h-auto block aspect-auto object-cover rounded-lg">
</div>

{{---

 <source media="(min-width:1000px)" srcset="{{asset('img/600x600/TrioLanding.png')}}">
        <source media="(min-width:768px)" srcset="{{asset('img/480x6480/TrioLanding.png')}}">
        <source media="(min-width:530px)" srcset="{{asset('img/800x800/TrioLanding.png')}}">
        <source media="(max-width:529px)" srcset="{{asset('img/480x480/TrioLanding.png')}}">
--}}
