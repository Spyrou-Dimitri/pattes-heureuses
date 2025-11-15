@props(['href' => '',
 'title' => '',
  'cta_title' => '',
   'class' => ''])

@php
    $classes_variants = [
            'primary' => 'cta-primary',
            'nav' => 'nav-link'
        ];

    $class_variant = $classes_variants[$class] ?? $classes_variants['primary']
@endphp

<a href="{{ $href }}" title=" {{$title}}" class="{{$class_variant}}">
    {{$slot}}
</a>
