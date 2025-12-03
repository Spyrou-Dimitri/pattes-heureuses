@props([
    'title',
    'align' => false,
])

<section class="flex flex-col gap-4">
    <h2 class="h2-section {{$align ? 'text-center' : 'left'}}">
        {{$title}}
    </h2>
    {{$slot}}
</section>
