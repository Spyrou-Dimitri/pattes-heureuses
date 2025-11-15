@props(
    [
        'bg'=> ''
]
)
@php
    $bg_variants = [
            'white-break' => 'bg-white-break',
        'gray' => 'bg-gray-100',
        'paws' => "bg-paws",
        ];

    $bg_variant = $bg_variants[$bg] ?? $bg_variants['primary']
@endphp


<section class="py-8 md:py-12 {{$bg_variant}}">
    {{$slot}}
</section>
