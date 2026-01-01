@props([
    'header_new_animals' => ['Photo', 'Nom', 'Type', 'Race', 'Age', 'Auteur'],
    'header_animals' => ['Photo', 'Nom', 'Type', 'Race', 'Age', 'Status'],
    'header_volunteers' => ['Photo', 'Nom', 'Prénom', 'email', 'Telephone'],
    'header_new_adoptions'=> ['Photo','Nom', 'Adopteur', 'Email', 'Telephone' ,'Date'],
    'header_adoptions'=> ['Photo','Nom', 'Adopteur', 'Email', 'Status'],
    'header_messagery' => [' ','Auteur', 'Objet', 'Date'],
    'header_messagery_dashboard' => ['Auteur', 'Objet', 'Date'],
    'header' => '',
    'datas_table' => [],
])

@php

    $header_choices = [
            'new_animals' => $header_new_animals,
            'volunteers' => $header_volunteers,
            'adoptions' => $header_adoptions,
            'new_adoptions' => $header_new_adoptions,
            'animals'=> $header_animals,
            'messagery' => $header_messagery,
            'messagery_dashboard' => $header_messagery_dashboard,
        ];

    $header_choice = $header_choices[$header] ?? $header_choices['new_animals'];
@endphp

<table class="md:w-full md:shadow-2xs md:overflow-hidden md:rounded-lg">
    <thead class="hidden md:table-header-group md:bg-gray-100 ">
    <tr class="font-poppins font-bold ">
        @foreach($header_choice as $column)
            <th class="md:py-4 md:px-4 md:text-left">
                {{$column}}
            </th>
        @endforeach
    </tr>
    </thead>
    <tbody class="flex flex-col gap-6 md:table-row-group">
        {{$slot}}
    </tbody>
</table>
