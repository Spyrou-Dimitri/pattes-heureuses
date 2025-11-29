<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div class="flex flex-col gap-12">
    <div class="fixed top-2 left-2 z-50 px-2 py-1 text-white text-sm font-bold rounded bg-black/70">
        <span class="block sm:hidden">XS ( < 640px )</span>
        <span class="hidden sm:block md:hidden">SM ( ≥ 640px )</span>
        <span class="hidden md:block lg:hidden">MD ( ≥ 768px )</span>
        <span class="hidden lg:block xl:hidden">LG ( ≥ 1024px )</span>
        <span class="hidden xl:block 2xl:hidden">XL ( ≥ 1280px )</span>
        <span class="hidden 2xl:block">2XL ( ≥ 1536px )</span>
    </div>
    <?php

    $animals = [
        [
            'img/animal/jean.jpeg',
            'Jean',
            'Chien',
            'Golden retriever',
            '5 ans',
            'Vilain Dominique',
        ],
        [
           'img/animal/bastien.jpg',
            'Bastien',
            'Chat',
            'Siamois',
            '3 ans',
            'Dupont Alice',
        ],
        [
            'img/animal/carlos.jpg',
            'Carlos',
            'Lapin',
            'Nain hollandais',
            '2 ans',
            'Martin Paul',
        ],
    ];
    $adoptions = [
        [
            'Chien',
            'Golden Retriever',
            'Jean',
            'Martin Sophie',
            '12/03/2025',
        ],
        [
            'Chat',
            'Siamois',
            'Bastien',
            'Durand Thomas',
            '28/02/2025',
        ],
        [
            'Lapin',
            'Nain hollandais',
            'Carlos',
            'Lefèvre Julie',
            '04/01/2025',
        ],
    ];

    ?>
    <x-admin.section :title="'Bienvenue Dimitri'">
        <ul class="flex flex-col gap-6 md:flex-row md:gap-12">
            <x-cards.stat-card :icons="'paws'"
            :title="'Nouveaux animaux'"
            :number="3">


            </x-cards.stat-card>
            <x-cards.stat-card :icons="'hearth'"
                               :title="'Nouvelles adoptions'"
                               :number="5">

            </x-cards.stat-card>
            <x-cards.stat-card :icons="'paws'"
                               :title="'Nouveaux animaux'"
                               :number="8">

            </x-cards.stat-card>



        </ul>

    </x-admin.section>


    <x-admin.section :title="'Nouveaux animaux'">
        <x-admin.table :header="'new_animals'"
                       :datas_table="$animals">

        </x-admin.table>
    </x-admin.section>
    <x-admin.section :title="'Nouvelles adoptions'">
        <x-admin.table :header="'new_adoptions'"
                       :datas_table="$adoptions">

        </x-admin.table>
    </x-admin.section>


</div>
