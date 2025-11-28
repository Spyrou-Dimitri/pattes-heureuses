@props([
    /*'photo' => false,
    'name_animal' => false,
    'type_animal' => false,
    'breed_animal' => false,
    'age_animal'=> false,
    'author_animal'=>false,
    */

    'header_new_animals' => ['Photo', 'Nom', 'Type', 'Race', 'Age', 'Auteur'],
    'header_volunteers' => ['Photo', 'Nom', 'email', 'Telephone', 'Action'],
    'header_new_adoptions'=> ['Type', 'Race', 'Nom', 'Adopteur', 'Date'],
    'header' => '',
    'datas_table' => [],
])

@php

    $header_choices = [
            'new_animals' => $header_new_animals,
            'volunteers' => $header_volunteers,
            'new_adoptions' => $header_new_adoptions
        ];

    $header_choice = $header_choices[$header] ?? $header_choices['new_animals'];
@endphp

<table class="md:w-full md:shadow-2xs">
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
    @foreach($datas_table as $data_table)
        <tr class="md:hover:bg-gray-100 md:cursor-pointer duration-300 md:hover:duration-300 md:border-b-2 md:border-b-gray-100 flex flex-col gap-3 font-poppins p-6 border-1 bg-white border-main-blue rounded-lg md:table-row md:border-0">
            @foreach($data_table as $key => $value)
                <td class=" md:py-4 md:px-4 flex justify-between md:table-cell">
                    @if($header_choice[$key] !== 'Photo')
                        <span class="font-bold md:hidden" id="toto">
                            {{$header_choice[$key]}}
                        </span>
                    @endif

                    @if (is_string($value) && preg_match('/\.(jpg|jpeg|png|webp|svg)$/i', $value))
                        <img src="{{ asset($value) }}" alt="" class="img-table">
                    @else
                        <span class="md:block" aria-labelledby="toto">
                            {{ $value }}
                        </span>
                    @endif

                </td>
            @endforeach
        </tr>
    @endforeach

    </tbody>
</table>
