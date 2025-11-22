@props(['href' => '',
 'title' => '',
  'cta_title' => '',
   'class' => '',
   'route' => ''])


<li class="nav__container__items">
    <a href="{{ $href }}"
       title="{{$title}}"
       class="nav-link {{ request()->routeIs($route) ? 'active' : '' }}">
        {{$slot}}
    </a>
</li>
