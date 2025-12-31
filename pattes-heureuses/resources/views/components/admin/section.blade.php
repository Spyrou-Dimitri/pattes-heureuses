@props([
    'title',
    'align' => false,
    'search_bar' => false,
    'term' => false,
])

<section class="flex flex-col gap-4">
    @if($search_bar)
        <div class="flex flex-wrap justify-between gap-3">
            <h2 class="h2-section {{$align ? 'text-center' : 'left'}}">
                {{$title}}
            </h2>
            <x-forms.input :term="$term" :type="'search'" :name="'animal-search'" :label="'Rechercher un animal'"
                           :placeholder="'Barre de recherche'"/>
        </div>

    @else
        <h2 class="h2-section {{$align ? 'text-center' : 'left'}}">
            {{$title}}
        </h2>
    @endif

    {{$slot}}
</section>
