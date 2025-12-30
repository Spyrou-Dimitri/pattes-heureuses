<x-layouts.auth>
    @php

    $profil = [
        'name' => $animal->name,
        'type' => $animal->breed->specie->name,
        'breed' => $animal->breed->name,
        'age' => $animal->age,
        'coat' => $animal->coats->pluck('name')->join(' / '),
        'vaccin' => $animal->vaccins->pluck('name')->join(' / ')
];

    $behavior = [
        'behavior' => $animal->behaviors->pluck('name')->join(' / '),
        'accept_dogs' => $animal->accept_dogs_label,
        'accept_kids' => $animal->accept_kids_label,
        'accept_cats' => $animal->accept_cats_label,
]

    @endphp
    <x-client.sections.animals.show.section-presentation-animal :animal="$animal" :behavior="$behavior" :profil="$profil"/>

</x-layouts.auth>
