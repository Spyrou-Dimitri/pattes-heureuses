@props(['href' => '',
 'title' => '',
  'cta_title' => '',
   'class' => '',
   'route' => ''])


<li class="">
    <a href="{{ $href }}"
       title="{{$title}}"
       class="nav-secondary-link {{ request()->routeIs($route) ? 'active-secondary-nav' : '' }}">
        {{$slot}}
    </a>
</li>
