@props(
    [
        'bg'=> '',
        'py'=> ''
]
)
@php
    $bg_variants = [
            'white-break' => 'bg-white-break',
        'gray' => 'bg-gray-100',
        'paws' => "bg-paws",
        'no-bg' => '',
        ];

    $bg_variant = $bg_variants[$bg] ?? $bg_variants['primary'];

$py_variants = [
            'landing' => 'py-8 md:py-12',
        'basic' => 'py-8 md:py-24',
        'login' => 'py-8 md:py-0',
        'basic-no-py' => 'py-0'
        ];
    $py_variant = $py_variants[$py] ?? $py_variants['basic'];

@endphp


<section class="{{$py_variant}} {{$bg_variant}}">
    {{$slot}}
</section>
