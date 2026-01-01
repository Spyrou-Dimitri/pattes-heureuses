@php
    $isAdoptionPage = request()->is('adoption*');
    $isLoginPage = request()->is('*login*');
    $isIndexAnimal = request()->is('animals*')
@endphp

<div {{ $attributes->class([
    'flex flex-col gap-4 m-auto  px-8',
    'max-w-[1200px]'  => ! $isLoginPage,
    'md:px-0' => $isLoginPage || $isIndexAnimal,
    'lg:gap-x-12 lg:grid lg:grid-cols-12 lg:auto-rows-auto' => $isAdoptionPage,
    'md:gap-x-12 md:grid md:grid-cols-12 md:auto-rows-auto' => ! $isAdoptionPage,
]) }}>
    {{ $slot }}
</div>
