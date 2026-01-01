<?php
$navigations = [
    [
        'title' => __('client/nav.title') . ' ' . __('client/nav.home'),
        'href' => route('home'),
        'label' => __('client/nav.home'),
        'route' => 'home'
    ],
    [
        'title' => __('client/nav.title') . ' ' . __('client/nav.about'),
        'href' => route('about'),
        'label' => __('client/nav.about'),
        'route' => 'about'

    ],
    [
        'title' => __('client/nav.title') . ' ' . __('client/nav.animals'),
        'href' => route('animals.index'),
        'label' => __('client/nav.animals'),
        'route' => 'animals.index'

    ],
    [
        'title' => __('client/nav.title') . ' ' . __('client/nav.contact'),
        'href' => route('contact.create'),
        'label' => __('client/nav.contact'),
        'route' => 'contact'
    ],
]
?>

<nav class="w-full sm:w-fit text-center sm:text-left flex flex-col gap-2">
    <h2 class="font-fredoka font-semibold text-2xl">
        Navigation
    </h2>
    <ul class="flex flex-col gap-2">
        @foreach($navigations as $navigation)
            <li class="font-poppins">
                <x-basics.navigation-secondary-link :href="$navigation['href']"
                                                    :title="$navigation['title']"
                                                    :route="$navigation['route']">
                    {{$navigation['label']}}
                </x-basics.navigation-secondary-link>
            </li>
        @endforeach
    </ul>

</nav>




