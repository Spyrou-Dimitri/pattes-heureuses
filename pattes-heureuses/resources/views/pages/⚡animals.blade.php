<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

@php


    $datas_table = [
        [
            'img/animal/jean.jpeg',
            'Mina',
            'Chat',
            'Européen',
            'Disponible',
            12,
        ],
        [
            'img/animal/Carlos.jpg',
            'Rex',
            'Chien',
            'Berger Allemand',
            'En soin',
            47,
        ],
        [
             'img/animal/Larry.jpg',
             'Fluffy',
             'Lapin',
             'Nain',
             'Adopté',
            83,
        ],
        [
             'img/animal/Samantha.jpg',
             'Shadow',
             'Chat',
             'Siamois',
             'Disponible',
            105,
        ],

    ];

@endphp


<div class="flex flex-col gap-12">

    <x-admin.section :title="'Statistiques'">
        <ul class="flex flex-col gap-6 md:flex-row md:gap-12">
            <x-cards.stat-card :icons="'paws'"
                               :title="'Animaux'"
                               :number="3">


            </x-cards.stat-card>
            <x-cards.stat-card :icons="'dog'"
                               :title="'Chiens'"
                               :number="5">

            </x-cards.stat-card>
            <x-cards.stat-card :icons="'cat'"
                               :title="'Chats'"
                               :number="8">
            </x-cards.stat-card>

        </ul>

    </x-admin.section>
    <x-admin.section :title="'Liste des animaux'">
        <div class="flex flex-col gap-4 justify-between md:items-center md:flex-row flex-wrap">
            <ul class="flex gap-4 md:gap-8 text-poppins flex-wrap">
                <li>
                    <a href="" class="filter_link">Tous</a>
                </li>
                <li>
                    <a href="" class="filter_link">Disponibles</a>

                </li>
                <li>
                    <a href="" class="filter_link">En soin</a>

                </li>
                <li>
                    <a href="" class="filter_link">Adopté</a>

                </li>
                <li>
                    <a href="" class="filter_link">Décédé</a>

                </li>
            </ul>
            <x-forms.input :type="'search'" :name="'animal-search'" :label="'Rechercher un animal'"
                           :placeholder="'Barre de recherche'">
            </x-forms.input>
            <div class="flex justify-between md:gap-4 md:justify-start">
                <a href="" class="cta-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="20" height="20" viewBox="0 0 24 24">
                        <path stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 4.6c0-.56 0-.84.109-1.054a1 1 0 0 1 .437-.437C3.76 3 4.04 3 4.6 3h14.8c.56 0 .84 0 1.054.109a1 1 0 0 1 .437.437C21 3.76 21 4.04 21 4.6v1.737c0 .245 0 .367-.028.482a.998.998 0 0 1-.12.29c-.061.1-.148.187-.32.36l-6.063 6.062c-.173.173-.26.26-.322.36a.998.998 0 0 0-.12.29c-.027.115-.027.237-.027.482V17l-4 4v-6.337c0-.245 0-.367-.028-.482a1 1 0 0 0-.12-.29c-.061-.1-.148-.187-.32-.36L3.468 7.47c-.173-.173-.26-.26-.322-.36a1 1 0 0 1-.12-.29C3 6.704 3 6.582 3 6.337V4.6Z"/>
                    </svg>
                    <span>
                    Filtres
                </span>
                </a>
                <x-basics.cta :title="'Créer une nouvelle fiche'">
                    Nouveau
                </x-basics.cta>
            </div>
        </div>
        <x-admin.table :header="'animals'"
                       :datas_table="$datas_table">
        </x-admin.table>


    </x-admin.section>
</div>

