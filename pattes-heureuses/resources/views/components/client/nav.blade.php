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
        <h2 aria-level="2">
        </h2>

        <a href="{{route('home')}}" title="Vers l'accueil" class="flex items-center gap-2">
            <svg id="Calque_2" data-name="Calque 2" width="80" height="80" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 219.02 262.39">
                <defs>
                    <style>
                        .cls-1, .cls-2 {
                            fill: none;
                        }

                        .cls-3 {
                            fill: #f1ead3;
                        }

                        .cls-3, .cls-4, .cls-2 {
                            stroke: #1d1d1b;
                            stroke-miterlimit: 10;
                            stroke-width: 6px;
                        }

                        .cls-4 {
                            fill: #1d1d1b;
                        }

                        .cls-5 {
                            clip-path: url(#clippath);
                        }

                        .cls-6 {
                            fill: #3bb7b4;
                        }
                    </style>
                    <clipPath id="clippath">
                        <path class="cls-1"
                              d="M109.51,259.39h94.34c6.72,0,12.17-5.45,12.17-12.17V109.83c0-5.55-2.21-10.88-6.13-14.8L123.78,8.91c-7.88-7.88-20.65-7.88-28.52,0L9.13,95.03c-3.93,3.93-6.13,9.25-6.13,14.8v137.39c0,6.72,5.45,12.17,12.17,12.17h94.34Z"/>
                    </clipPath>
                </defs>
                <g id="Calque_2-2" data-name="Calque 2">
                    <g id="uuid-46b7eef3-0b97-48e2-b43f-2379870d2764" data-name="Calque 2-2">
                        <g>
                            <path class="cls-6"
                                  d="M109.51,259.39h94.34c6.72,0,12.17-5.45,12.17-12.17V109.83c0-5.55-2.21-10.88-6.13-14.8L123.78,8.91c-7.88-7.88-20.65-7.88-28.52,0L9.13,95.03c-3.93,3.93-6.13,9.25-6.13,14.8v137.39c0,6.72,5.45,12.17,12.17,12.17h94.34Z"/>
                            <g class="cls-5">
                                <g>
                                    <g>
                                        <path class="cls-3"
                                              d="M133.63,270.3l-73.95-83.04c-16.04-1.53-27.8-10.07-32.76-22.75-1.07-2.74,0-5.86,2.53-7.37l6.03-3.62c1.08-.65,2.09-1.42,2.92-2.37,3.3-3.82,3.34-8.86,1.44-14.63-1.61-4.88-2.53-9.97-2.29-15.1,1.13-24.06,14.58-39.45,39.96-46.43,8.27-2.28,16.99-2.47,25.37-.63,29.08,6.37,49.57,22.77,52.72,59.44,39.85,35.68,44.61,82.31,30.61,134.79l-52.57,1.71h-.01Z"/>
                                        <path class="cls-3" d="M53.78,134.69c6.5,3.69,11.97,4.1,14.37-5.26"/>
                                        <path class="cls-3" d="M51.75,170.51c-4.49,6.4-9.98,8.53-16.49,6.4"/>
                                        <path class="cls-3" d="M87.97,109.6c22.75,36.15,45.36,53.83,67.62,24.2"/>
                                        <path class="cls-4"
                                              d="M35.48,153.52c4.65,1.69,5.33,5.65,4.02,10.74-3.07,6.17-7.26,5.16-11.76,2.16-2.5-6.27,1.19-10.14,7.74-12.9h0Z"/>
                                    </g>
                                    <g>
                                        <path class="cls-3"
                                              d="M18.46,270.3c1.7-50.72,30.6-90.84,97.43-116.15.78-.29,1.61.31,1.56,1.14l-.77,13.01c-.05.81.37,1.57,1.08,1.97,10.81,6.24,18.4,14.4,20.05,26.08.17,1.23,1.34,2.07,2.56,1.8l14.81-3.26c.84-.19,1.59.6,1.36,1.43-3.7,13.35-9.08,25.15-17.41,34.23-1.38,1.5-3.05,2.7-4.82,3.71-10.19,5.83-14.02,16.35-7.84,34.25l-108.02,1.79h.01Z"/>
                                        <g>
                                            <line class="cls-2" x1="80.86" y1="182.59" x2="87.75" y2="193.87"/>
                                            <line class="cls-2" x1="74.24" y1="189.7" x2="80.86" y2="196.08"/>
                                            <path class="cls-3" d="M95.34,186.76c3.56,3.38,4.83,7.09,2.94,11.29"/>
                                            <path class="cls-3" d="M111.49,210.54c4.89-.33,8.49,1.25,10.29,5.48"/>
                                            <g>
                                                <path class="cls-3"
                                                      d="M85.96,206.45c1.14,5.63,3.53,8.47,8.06,6.58.74-.31,1.51.36,1.26,1.13-1.47,4.61-1.14,8.33,5.75,8.85"/>
                                                <path class="cls-3"
                                                      d="M97.18,207.64l-1.31,4.65,4.69-1.19c.05,0,.07-.08.03-.12l-3.29-3.37s-.11-.02-.12.03Z"/>
                                            </g>
                                            <line class="cls-2" x1="113.64" y1="222.67" x2="124.91" y2="229.97"/>
                                            <line class="cls-2" x1="110.24" y1="227.64" x2="116.03" y2="236.02"/>
                                        </g>
                                    </g>
                                </g>
                            </g>
                            <path class="cls-2"
                                  d="M109.51,259.39h94.34c6.72,0,12.17-5.45,12.17-12.17V109.83c0-5.55-2.21-10.88-6.13-14.8L123.78,8.91c-7.88-7.88-20.65-7.88-28.52,0L9.13,95.03c-3.93,3.93-6.13,9.25-6.13,14.8v137.39c0,6.72,5.45,12.17,12.17,12.17h94.34Z"/>
                        </g>
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
