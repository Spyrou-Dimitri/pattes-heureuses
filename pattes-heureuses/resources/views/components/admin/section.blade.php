@props([
    'title'
])

<section class="flex flex-col gap-4">
    <h2 class="h2-section">
        {{$title}}
    </h2>
    {{$slot}}
</section>
