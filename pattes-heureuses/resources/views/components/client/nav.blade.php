@php
    $navigations = [
        [
            'title' => __('client/nav.title'). ' ' .__('client/nav.home'),
            'href' => route('home'),
            'label' => __('client/nav.home'),
            'route' => 'home'
        ],
        [
            'title' => __('client/nav.title'). ' ' .__('client/nav.about'),
            'href' => route('about'),
            'label' => __('client/nav.about'),
            'route' => 'about'

        ],
        [
            'title' => __('client/nav.title'). ' ' .__('client/nav.animals'),
            'href' => route('animals.index'),
            'label' => __('client/nav.animals'),
            'route' => 'animals.index'

        ],
        [
            'title' => __('client/nav.title'). ' ' .__('client/nav.contact'),
            'href' => route('contact'),
            'label' => __('client/nav.contact'),
            'route' => 'contact'

        ],
        [
            'title' => __('client/nav.change-langue'),
            'href' => route('contact'),
            'label' => __('client/nav.lang'),
            'route' => 'lang'
            ]
]
@endphp

<div class="max-w-[1200px] mx-auto">
    <nav class="relative flex flex-col px-8 py-4 max-w-full mx-auto lg:w-auto lg:flex-row lg:justify-between">
        <h2 aria-level="2" class="hidden">
            Navigation principale
        </h2>

        <a href="{{route('home')}}" title="Vers l'accueil" class="flex items-center gap-2">
            <svg width="75" height="75" id="Calque_2" data-name="Calque 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 196.55 172.92">
                <defs>
                    <style>

                        .cls-1 { fill: #39b9b5; stroke: none; }
                        .cls-2 { fill: #eb770f; stroke: none; }


                    </style>
                </defs>
                <g id="Calque_1-2" data-name="Calque 1">
                    <path class="cls-2" fill="none" stroke="#eb770f" stroke-width="3"
                          d="M14.37,88.31C-29.03,35.52,34.84-32.9,86.75,17.79c5.5,5.32,10.16,11.35,14.34,17.63l-4.66-.04C110.34,15.48,134.29-4.51,160.08,3.3c21.14,7.01,34.98,28.72,36.42,50.41,1.63,40.58-35.17,74.8-64.6,98.01-9.77,7.54-19.86,14.63-30.26,21.21l-.35-.49c27.08-22.14,54.8-44.39,75.13-73.15,1.2-1.81,2.52-3.83,3.75-5.64,1.33-2.24,3.3-5.49,4.49-7.81.73-1.45,1.81-3.58,2.54-5.02,2.45-5.76,4.88-11.89,5.8-18.09,2.15-12.59-.63-25.95-7.49-36.73-6.08-9.34-15.23-17.39-26.14-20.23-24.57-6.09-45.42,14.11-58.31,32.83,0,0-2.3,3.34-2.3,3.34-4.78-7.03-10.01-14.03-16.22-19.74-10.09-9.53-23.28-16.5-37.32-15.82C23.82,7.26,6.65,26.25,4.17,46.97c-2.03,14.37,2.52,29.02,10.68,40.98,0,0-.48.36-.48.36h0Z"/>
                    <path class="cls-2"
                          d="M46.56,63.1c-6.03.11-11.8-.97-17.25-3.44-2.17-.98-4.21-2.27-5.82-4.02-7.22-7.84-.73-16.28,11.7-9.81-.83-11.77,6.4-17.37,11.79-9.24,1.49,2.25,2.3,4.89,2.44,7.59.34,6.32-.5,12.63-2.87,18.92Z"/>
                    <path class="cls-2"
                          d="M68.47,70.05c-3.22-2.73-5.74-5.96-7.47-9.77-.69-1.52-1.16-3.14-1.2-4.8-.17-7.45,7.14-8.88,10.67.26,5-6.56,11.39-6.16,10.46.6-.26,1.87-1.05,3.63-2.22,5.11-2.74,3.48-6.1,6.4-10.24,8.61Z"/>
                    <g>
                        <path class="cls-1"
                              d="M58.07,116.32c2.01-5.3,5.88-6.77,11.63-4.41,3.31,1.99,6.49,3.84,8.9,4.85,1.87.79,3.65,1.81,5.15,3.19,6.16,5.67,5.8,12.28-1.49,12.28-9.59-1.08-15.7.63-18.05,5.35-3.02,3.72-8.34,6.42-11.44,1.51-1.5-2.38-1.64-5.38-.6-7.99l5.89-14.77Z"/>
                        <ellipse class="cls-1" cx="49.61" cy="99.55" rx="6.6" ry="10.92"
                                 transform="translate(-40.92 34.93) rotate(-27.99)"/>
                        <ellipse class="cls-1" cx="65.88" cy="92.82" rx="6.6" ry="10.92"
                                 transform="translate(-10.68 8.59) rotate(-6.9)"/>
                        <ellipse class="cls-1" cx="82.16" cy="103.69" rx="10.22" ry="6.17"
                                 transform="translate(-39.36 155.98) rotate(-74.89)"/>
                        <ellipse class="cls-1" cx="42.88" cy="117.43" rx="6.17" ry="10.22"
                                 transform="translate(-77.72 84.5) rotate(-54.67)"/>
                    </g>
                    <g>
                        <path class="cls-1"
                              d="M118.89,88.68c4.59-3.32,8.64-2.42,12.14,2.72,1.67,3.48,3.3,6.78,4.76,8.95,1.13,1.69,2.05,3.52,2.54,5.49,2.02,8.12-1.91,13.44-8,9.43-7.41-6.18-13.45-8.11-18.01-5.47-4.56,1.44-10.49.78-10.38-5.04.05-2.81,1.59-5.39,3.9-7l13.04-9.1Z"/>
                        <ellipse class="cls-1" cx="121.05" cy="70.02" rx="10.92" ry="6.6"
                                 transform="translate(39.95 183.95) rotate(-84.6)"/>
                        <ellipse class="cls-1" cx="138.34" cy="73.36" rx="10.92" ry="6.6"
                                 transform="translate(10.99 164.47) rotate(-63.52)"/>
                        <ellipse class="cls-1" cx="145.95" cy="91.39" rx="10.22" ry="6.17"
                                 transform="translate(-23.92 119.66) rotate(-41.5)"/>
                        <ellipse class="cls-1" cx="105.59" cy="81.25" rx="6.17" ry="10.22"
                                 transform="translate(-22.29 43.86) rotate(-21.28)"/>
                    </g>
                </g>
            </svg>

            <span class="font-fredoka font-medium text-xl">
                Pattes
                <span class="block">
                    Heureuses
                </span>
            </span>
        </a>
        <x-basics.burger></x-basics.burger>
        <div class="bg-white fixed top-0 right-0 z-30 transform translate-x-[100%] transition-all duration-300 ease-in-out w-full min-h-screen
            flex flex-col py-40 items-center justify-around nav__lists
            lg:static lg:translate-x-0 lg:right-auto lg:top-auto lg:min-h-auto lg:flex-row lg:py-0 lg:w-auto lg: ml-auto    ">
            <ul class="flex flex-col gap-8 items-center lg:flex-row lg:gap-20">
                @foreach($navigations as $navigation)
                    <x-basics.navigation-link
                        :href="$navigation['href']"
                        :title="$navigation['title']"
                        :route="$navigation['route']">


                        {{$navigation['label']}}
                    </x-basics.navigation-link>
                @endforeach

            </ul>
        </div>



    </nav>
</div>
