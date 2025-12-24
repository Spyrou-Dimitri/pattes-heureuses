@php use App\Enums\AdoptionStatus;use App\Enums\AnimalStatus;use App\Models\Adoption;use App\Models\Animal; @endphp
@props(['href' => '',
 'title' => '',
  'cta_title' => '',
   'class' => '',
   'route' => ''])

@php
    $notifications_dashboard = Animal::where('state', AnimalStatus::PENDING)->count() + Adoption::where('status', AdoptionStatus::Pending)->count();
    $notifications_animals = Animal::where('state', AnimalStatus::PENDING)->count();
    $notifications_adoptions = Adoption::where('status', AdoptionStatus::Pending)->count();
@endphp
<li class="lg:w-full">
    <a href="{{ $href }}"
       title="{{$title}}"
       class="nav-link-admin flex flex-row gap-2  items-center p-4 rounded-lg {{ request()->routeIs($route) ? 'active-admin' : '' }}">
        @switch($slot)
            @case('Dashboard')
                <svg width="20" height="20" viewBox="0 0 16 16"
                     fill="{{ request()->routeIs($route) ? 'white' : 'none' }}" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M9.6 14.5996V7.59961M5.6 7.59961V0.599609M0.599998 7.59961H14.6M0.599998 14.5996H14.6V0.599609H0.599998V14.5996Z"
                        fill="{{ request()->routeIs($route) ? 'white' : 'none' }}"
                        stroke="{{ request()->routeIs($route) ? '#EB770F' : '#121923' }} " stroke-opacity="1"
                        stroke-width="1.2"/>
                </svg>

                @break
            @case('Animaux')
                <svg id="Calque_2" data-name="Calque 2" width="20" height="30" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 46 40.99">
                    <defs>
                        <style>
                            .paws-icon {
                                fill: {{request()->routeIs($route) ? 'white' : 'none'}} ;
                                stroke: {{request()->routeIs($route) ? 'none' : 'black'}};
                                stroke-width: 1.5;
                                stroke-miterlimit: 10;
                            }
                        </style>
                    </defs>
                    <g id="Calque_2-2" data-name="Calque 2">
                        <g id="Calque_1-2" data-name="Calque 1-2">
                            <path class="paws-icon"
                                  d="M22.82,38.79c1.33.16,2.88.25,4.77,1.01,1.72.63,3.4.85,5.03.58,1.99-.32,3.66-1.68,4.38-3.56.84-2.18.62-4.44-.4-6.75-.65-1.47-1.62-2.77-2.78-3.88-1.46-1.39-2.72-3.01-3.89-4.75-3.03-4.51-4.13-5.65-7.11-5.63-2.98-.01-4.08,1.12-7.11,5.63-1.17,1.74-2.44,3.36-3.89,4.75-1.16,1.11-2.13,2.41-2.78,3.88-1.02,2.31-1.24,4.57-.4,6.75.72,1.88,2.39,3.24,4.38,3.56,1.64.27,3.32.04,5.03-.58,1.89-.77,3.44-.85,4.77-1.01h0ZM9.2,24.64c2.48-1.31,3.06-5.13,1.3-8.51-1.76-3.39-5.2-5.06-7.68-3.75C.34,13.7-.24,17.51,1.52,20.89c1.76,3.39,5.2,5.06,7.68,3.75ZM43.99,21.29c2.13-3.16,1.99-7.01-.33-8.61s-5.92-.32-8.06,2.84c-2.13,3.16-1.99,7.01.33,8.61,2.31,1.59,5.92.32,8.06-2.84ZM34.54,9.42c1.23-3.97.03-7.87-2.67-8.72-2.7-.85-5.89,1.67-7.11,5.64-1.23,3.97-.03,7.87,2.67,8.72s5.89-1.67,7.11-5.64ZM18.13,15.12c2.72-.78,4.03-4.65,2.91-8.65S16.8-.14,14.08.64c-2.72.78-4.02,4.65-2.91,8.65,1.12,4,4.23,6.61,6.95,5.84h.01Z"/>
                        </g>
                    </g>
                </svg>
                @break
            @case('Messagerie')
                <svg width="20" height="20" viewBox="0 0 19 15" fill="{{request()->routeIs($route) ? 'white' : 'none'}}"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M18.5001 3.5L14.9393 5.47822C12.9541 6.5811 11.9615 7.1326 10.9103 7.3488C9.97989 7.5401 9.02029 7.5401 8.08989 7.3488C7.03873 7.1326 6.04612 6.5811 4.06089 5.47822L0.500092 3.5M3.70009 14.5H15.3001C16.4202 14.5 16.9803 14.5 17.4081 14.282C17.7844 14.0903 18.0904 13.7843 18.2821 13.408C18.5001 12.9802 18.5001 12.4201 18.5001 11.3V3.7C18.5001 2.5799 18.5001 2.01984 18.2821 1.59202C18.0904 1.21569 17.7844 0.90973 17.4081 0.71799C16.9803 0.5 16.4202 0.5 15.3001 0.5H3.70009C2.57999 0.5 2.01993 0.5 1.59211 0.71799C1.21578 0.90973 0.909821 1.21569 0.718081 1.59202C0.500091 2.01984 0.500092 2.57989 0.500092 3.7V11.3C0.500092 12.4201 0.500091 12.9802 0.718081 13.408C0.909821 13.7843 1.21578 14.0903 1.59211 14.282C2.01993 14.5 2.57998 14.5 3.70009 14.5Z"
                        stroke="{{request()->routeIs($route) ? 'none' : 'black'}}" stroke-opacity="1"
                        stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                @break
            @case('Adoptions')
                <svg id="Calque_2" width="20" height="20" data-name="Calque 2" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 41 41.19">
                    <defs>
                        <style>
                            .hearth-icon {
                                fill: {{request()->routeIs($route) ? 'white' : 'none'}};
                                stroke: {{request()->routeIs($route) ? 'none' : 'black'}};
                                stroke-width: 1.5;
                                stroke-miterlimit: 10;
                            }
                        </style>
                    </defs>
                    <g id="Calque_1-2" data-name="Calque 1">
                        <path class="hearth-icon"
                              d="M20.5,40.5c7.56-7.15,15.84-14.5,18.27-20.2.23-.54.47-1.06.73-1.59,1.44-2.92,1.2-7.09.08-10.79-.43-1.42-1.09-2.75-2-3.88C33.13-1.47,24.97-.48,20.5,6.52,16.03-.48,7.87-1.47,3.42,4.05c-.91,1.13-1.57,2.46-2,3.88-1.12,3.7-1.35,7.87.08,10.79.26.52.5,1.05.73,1.59,2.43,5.7,10.72,13.05,18.27,20.2Z"/>
                    </g>
                </svg>
                @break
            @case('Personnels')
                <svg width="20" height="20" viewBox="0 0 15 19" fill="{{request()->routeIs($route) ? 'white' : 'none'}}"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.5 4.5C11.5 6.70914 9.7091 8.5 7.5 8.5C5.29086 8.5 3.5 6.70914 3.5 4.5C3.5 2.29086 5.29086 0.5 7.5 0.5C9.7091 0.5 11.5 2.29086 11.5 4.5Z"
                        stroke="{{request()->routeIs($route) ? 'none' : 'black'}}" stroke-opacity="1"
                        stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7.5 11.5C3.63401 11.5 0.5 14.634 0.5 18.5H14.5C14.5 14.634 11.366 11.5 7.5 11.5Z"
                          stroke="{{request()->routeIs($route) ? 'none' : 'black'}}" stroke-opacity="1"
                          stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                @break
            @case('Paramètres')
                <svg id="Calque_2" data-name="Calque 2" width="20" height="30" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 46 40.99">
                    <defs>
                        <style>
                            .paws-icon {
                                fill: {{request()->routeIs($route) ? 'white' : 'none'}} ;
                                stroke: {{request()->routeIs($route) ? 'none' : 'black'}};
                                stroke-width: 1.5;
                                stroke-miterlimit: 10;
                            }
                        </style>
                    </defs>
                    <g id="Calque_2-2" data-name="Calque 2">
                        <g id="Calque_1-2" data-name="Calque 1-2">
                            <path class="paws-icon"
                                  d="M22.82,38.79c1.33.16,2.88.25,4.77,1.01,1.72.63,3.4.85,5.03.58,1.99-.32,3.66-1.68,4.38-3.56.84-2.18.62-4.44-.4-6.75-.65-1.47-1.62-2.77-2.78-3.88-1.46-1.39-2.72-3.01-3.89-4.75-3.03-4.51-4.13-5.65-7.11-5.63-2.98-.01-4.08,1.12-7.11,5.63-1.17,1.74-2.44,3.36-3.89,4.75-1.16,1.11-2.13,2.41-2.78,3.88-1.02,2.31-1.24,4.57-.4,6.75.72,1.88,2.39,3.24,4.38,3.56,1.64.27,3.32.04,5.03-.58,1.89-.77,3.44-.85,4.77-1.01h0ZM9.2,24.64c2.48-1.31,3.06-5.13,1.3-8.51-1.76-3.39-5.2-5.06-7.68-3.75C.34,13.7-.24,17.51,1.52,20.89c1.76,3.39,5.2,5.06,7.68,3.75ZM43.99,21.29c2.13-3.16,1.99-7.01-.33-8.61s-5.92-.32-8.06,2.84c-2.13,3.16-1.99,7.01.33,8.61,2.31,1.59,5.92.32,8.06-2.84ZM34.54,9.42c1.23-3.97.03-7.87-2.67-8.72-2.7-.85-5.89,1.67-7.11,5.64-1.23,3.97-.03,7.87,2.67,8.72s5.89-1.67,7.11-5.64ZM18.13,15.12c2.72-.78,4.03-4.65,2.91-8.65S16.8-.14,14.08.64c-2.72.78-4.02,4.65-2.91,8.65,1.12,4,4.23,6.61,6.95,5.84h.01Z"/>
                        </g>
                    </g>
                </svg>
                @break

        @endswitch
        <span>
            {{$slot}}
        </span>
        @switch($route)
            @case('dashboard')
                @if($notifications_dashboard > 0)
                    <span class="text-lg  bg-red-600 w-7 h-7 align-middle text-white text-center rounded-full">
                        {{$notifications_dashboard}}
                    </span>
                @endif

                @break
            @case('animals')
                @if($notifications_animals > 0)
                    <span class="text-lg  bg-red-600 w-7 h-7 align-middle text-white text-center rounded-full">
                        {{$notifications_animals}}
                    </span>
                @endif
                @break
            @case('adoptions')
                @if($notifications_adoptions > 0)
                    <span class="text-lg  bg-red-600 w-7 h-7 align-middle text-white text-center rounded-full">
                        {{$notifications_adoptions}}
                    </span>
                @endif

                @break
        @endswitch

    </a>
</li>
