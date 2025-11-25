@php
    $isAdoptionPage = request()->is('adoption*');
    $isLoginPage = request()->is('login*');
@endphp

<div {{ $attributes->class([
    // Par défaut
    'flex flex-col gap-4 m-auto  px-8',

    // Propriété par défaut sauf pour le login
    'max-w-[1200px]'  => ! $isLoginPage,

    //Enlève le padding pour la login page lorsque le breakpoint est franchi
    'md:px-0' => $isLoginPage,



    // Layout pour l'adoption
    'lg:gap-x-12 lg:grid lg:grid-cols-12 lg:auto-rows-auto' => $isAdoptionPage,

    // Suite du layout par défaut le breakpoint md en général, sauf pour la page d'adoption ou le lg était plus adapté
    'md:gap-x-12 md:grid md:grid-cols-12 md:auto-rows-auto' => ! $isAdoptionPage,
]) }}>
    {{ $slot }}
</div>
