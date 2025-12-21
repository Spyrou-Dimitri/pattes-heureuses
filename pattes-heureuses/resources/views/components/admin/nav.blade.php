@php
    $navigations = [
        [
            'title' => __('admin/nav.title'). ' ' .__('admin/nav.dashboard'),
            'href' => route('dashboard'),
            'label' => __('admin/nav.dashboard'),
            'route' => 'dashboard'
        ],
        [
            'title' => __('admin/nav.title'). ' ' .__('admin/nav.animals'),
            'href' => route('animals'),
            'label' => __('client/nav.animals'),
            'route' => 'animals'

        ],
        [
            'title' => __('admin/nav.title'). ' ' .__('admin/nav.messagery'),
            'href' => route('animals.index'),
            'label' => __('admin/nav.messagery'),
            'route' => 'dashboar'

        ],
        [
            'title' => __('admin/nav.title'). ' ' .__('admin/nav.adoptions'),
            'href' => route('adoptions'),
            'label' => __('admin/nav.adoptions'),
            'route' => 'adoptions'

        ],
        [
            'title' => __('admin/nav.title'). ' ' .__('admin/nav.volunteers'),
            'href' => route('volunteers'),
            'label' => __('admin/nav.volunteers'),
            'route' => 'volunteers'
        ],
]
@endphp
<div class="relative lg:fixed lg:top-0 lg:left-0 lg:h-screen lg:w-[250px] bg-white shadow-md">
    <nav class="relative flex flex-col px-8 py-6 max-w-full mx-auto lg:w-auto lg:justify-between lg:min-h-full">
        <h2 aria-level="" class="sr-only">
            Navigation principale
        </h2>

        <a href="{{route('home')}}" title="Vers l'accueil" class="flex items-center gap-2">
            <svg width="75" height="75" id="Calque_2" data-name="Calque 2" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 196.55 172.92">
                <defs>
                    <style>
                        .paws {
                            fill: #39b9b5;
                            stroke: none;
                        }

                        .hearth {
                            fill: #eb770f;
                            stroke: none;
                        }
                    </style>
                </defs>
                <g id="Calque_1-2" data-name="Calque 1">
                    <path class="hearth" fill="none" stroke="#eb770f" stroke-width="3"
                          d="M14.37,88.31C-29.03,35.52,34.84-32.9,86.75,17.79c5.5,5.32,10.16,11.35,14.34,17.63l-4.66-.04C110.34,15.48,134.29-4.51,160.08,3.3c21.14,7.01,34.98,28.72,36.42,50.41,1.63,40.58-35.17,74.8-64.6,98.01-9.77,7.54-19.86,14.63-30.26,21.21l-.35-.49c27.08-22.14,54.8-44.39,75.13-73.15,1.2-1.81,2.52-3.83,3.75-5.64,1.33-2.24,3.3-5.49,4.49-7.81.73-1.45,1.81-3.58,2.54-5.02,2.45-5.76,4.88-11.89,5.8-18.09,2.15-12.59-.63-25.95-7.49-36.73-6.08-9.34-15.23-17.39-26.14-20.23-24.57-6.09-45.42,14.11-58.31,32.83,0,0-2.3,3.34-2.3,3.34-4.78-7.03-10.01-14.03-16.22-19.74-10.09-9.53-23.28-16.5-37.32-15.82C23.82,7.26,6.65,26.25,4.17,46.97c-2.03,14.37,2.52,29.02,10.68,40.98,0,0-.48.36-.48.36h0Z"/>
                    <path class="hearth"
                          d="M46.56,63.1c-6.03.11-11.8-.97-17.25-3.44-2.17-.98-4.21-2.27-5.82-4.02-7.22-7.84-.73-16.28,11.7-9.81-.83-11.77,6.4-17.37,11.79-9.24,1.49,2.25,2.3,4.89,2.44,7.59.34,6.32-.5,12.63-2.87,18.92Z"/>
                    <path class="hearth"
                          d="M68.47,70.05c-3.22-2.73-5.74-5.96-7.47-9.77-.69-1.52-1.16-3.14-1.2-4.8-.17-7.45,7.14-8.88,10.67.26,5-6.56,11.39-6.16,10.46.6-.26,1.87-1.05,3.63-2.22,5.11-2.74,3.48-6.1,6.4-10.24,8.61Z"/>
                    <g>
                        <path class="paws"
                              d="M58.07,116.32c2.01-5.3,5.88-6.77,11.63-4.41,3.31,1.99,6.49,3.84,8.9,4.85,1.87.79,3.65,1.81,5.15,3.19,6.16,5.67,5.8,12.28-1.49,12.28-9.59-1.08-15.7.63-18.05,5.35-3.02,3.72-8.34,6.42-11.44,1.51-1.5-2.38-1.64-5.38-.6-7.99l5.89-14.77Z"/>
                        <ellipse class="paws" cx="49.61" cy="99.55" rx="6.6" ry="10.92"
                                 transform="translate(-40.92 34.93) rotate(-27.99)"/>
                        <ellipse class="paws" cx="65.88" cy="92.82" rx="6.6" ry="10.92"
                                 transform="translate(-10.68 8.59) rotate(-6.9)"/>
                        <ellipse class="paws" cx="82.16" cy="103.69" rx="10.22" ry="6.17"
                                 transform="translate(-39.36 155.98) rotate(-74.89)"/>
                        <ellipse class="paws" cx="42.88" cy="117.43" rx="6.17" ry="10.22"
                                 transform="translate(-77.72 84.5) rotate(-54.67)"/>
                    </g>
                    <g>
                        <path class="paws"
                              d="M118.89,88.68c4.59-3.32,8.64-2.42,12.14,2.72,1.67,3.48,3.3,6.78,4.76,8.95,1.13,1.69,2.05,3.52,2.54,5.49,2.02,8.12-1.91,13.44-8,9.43-7.41-6.18-13.45-8.11-18.01-5.47-4.56,1.44-10.49.78-10.38-5.04.05-2.81,1.59-5.39,3.9-7l13.04-9.1Z"/>
                        <ellipse class="paws" cx="121.05" cy="70.02" rx="10.92" ry="6.6"
                                 transform="translate(39.95 183.95) rotate(-84.6)"/>
                        <ellipse class="paws" cx="138.34" cy="73.36" rx="10.92" ry="6.6"
                                 transform="translate(10.99 164.47) rotate(-63.52)"/>
                        <ellipse class="paws" cx="145.95" cy="91.39" rx="10.22" ry="6.17"
                                 transform="translate(-23.92 119.66) rotate(-41.5)"/>
                        <ellipse class="paws" cx="105.59" cy="81.25" rx="6.17" ry="10.22"
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
        <x-basics.burger>

        </x-basics.burger>
        <div class="bg-white fixed top-0 right-0 z-30 transform -translate-x-[100%] transition-all duration-300 ease-in-out w-full min-h-screen
            flex flex-col py-20 items-center justify-around nav__lists
            lg:static lg:flex-1 lg:translate-x-0 lg:right-auto lg:top-auto lg:min-h-auto lg:py-0">
            <ul class="flex flex-col gap-4  items-center w-full">
                @foreach($navigations as $navigation)
                    <x-basics.navigation-link-admin
                        :href="$navigation['href']"
                        :title="$navigation['title']"
                        :route="$navigation['route']">
                        {{$navigation['label']}}
                    </x-basics.navigation-link-admin>

                @endforeach
                <x-basics.navigation-link-admin :title="__('admin/nav.title'). ' ' .__('admin/nav.settings')"
                                                :href="route('settings')"
                                                :route="'settings'">
                    {{__('admin/nav.settings')}}
                </x-basics.navigation-link-admin>
            </ul>
            <div class="flex flex-col gap-4 lg:w-full">
                <div class="relative p-4 flex flex-row  items-center gap-2">
                    <a href="{{route('volunteers-show', auth()->user()->id)}}" class="absolute inset-0 z-10">
                        <span class="sr-only">
                            Compte
                        </span>
                    </a>
                    <img class="img-profil" src="{{asset('img/animal/jean.jpeg')}}" alt="">
                    <div class="flex flex-col font-fredoka text-xl">
                        <span>
                            {{auth()->user()->last_name}}
                        </span>
                        <small>
                            {{auth()->user()->role}}
                        </small>
                    </div>
                </div>

                <form action="{{route('logout')}}" method="post" class="w-full">
                    @csrf
                    <button
                        class=" p-4 hover:duration-300 duration-300 cursor-pointer font-fredoka text-xl transition-all flex gap-2 items-center justify-center text-center hover:bg-red-600 py-6 rounded-lg w-full text-red-600 hover:text-white">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.5 17.5H15.8333C16.2754 17.5 16.6993 17.3244 17.0118 17.0118C17.3244 16.6993 17.5 16.2754 17.5 15.8333V4.16667C17.5 3.72464 17.3244 3.30072 17.0118 2.98816C16.6993 2.67559 16.2754 2.5 15.8333 2.5H12.5"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6.6665 14.1667L2.49984 10L6.6665 5.83337" stroke="currentColor" stroke-width="2"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M2.5 10H12.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>

    </nav>
</div>
