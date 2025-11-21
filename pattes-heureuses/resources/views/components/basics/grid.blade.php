@php
    $isAdoptionPage = request()->is('adoption*');
@endphp


<div {{ $attributes->merge([
    'class' => 'max-w-[1200px] m-auto px-8 flex flex-col gap-4 '
             . ($isAdoptionPage ? 'lg:gap-x-12 lg:grid lg:grid-cols-12 lg:auto-rows-auto'
                                : 'md:gap-x-12 md:grid md:grid-cols-12 md:auto-rows-auto')
]) }}>
    {{ $slot }}
</div>

