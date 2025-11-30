<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

@php
    $types = collect([
        (object)[ 'id' => 1, 'name' => 'Chien' ],
        (object)[ 'id' => 2, 'name' => 'Chat' ],
        (object)[ 'id' => 3, 'name' => 'Autres' ],
    ]);

    $statuses = collect([
    (object)[ 'id' => 1, 'name' => 'Disponible' ],
    (object)[ 'id' => 2, 'name' => 'Réservé' ],
    (object)[ 'id' => 3, 'name' => 'Adopté' ],
    (object)[ 'id' => 4, 'name' => 'Indisponible' ],
]);


    $sexes = collect([
        (object)[ 'id' => 1, 'name' => 'Male' ],
        (object)[ 'id' => 2, 'name' => 'Femelle' ],
    ]);

    $breeds = collect([
        (object)[ 'id' => 1, 'name' => 'Berger Allemand' ],
        (object)[ 'id' => 2, 'name' => 'Labrador' ],
        (object)[ 'id' => 3, 'name' => 'Golden Retriever' ],
        (object)[ 'id' => 4, 'name' => 'Bouledogue Français' ],
        (object)[ 'id' => 5, 'name' => 'Siamois' ],
        (object)[ 'id' => 6, 'name' => 'Maine Coon' ],
        (object)[ 'id' => 7, 'name' => 'Persan' ],
        (object)[ 'id' => 8, 'name' => 'Lapin Nain' ],
        (object)[ 'id' => 9, 'name' => 'Furet Domestique' ],
    ]);
@endphp


<div class="flex flex-col gap-12">
    <x-admin.section :title="'Créer une nouvelle fiche'">
        <form action="#" method="post" class="flex flex-col gap-12 border-2 border-main-blue rounded-lg p-6 bg-white">
            <fieldset class="flex flex-col gap-6">
                <legend>
                    Informations sur l'animal
                </legend>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between border-t-2 border-t-main-blue pt-5">
                    <x-forms.input class="w-full" :type="'file'" :name="'animal-avatar'" :label="'Photo'"/>
                    <x-forms.input class="w-full" :type="'text'" :name="'animal-name'" :label="'Nom'" :placeholder="'Peanut'"/>
                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <x-forms.select :name="'animal-type'" :label="'Type'" :options="$types"/>
                    <x-forms.select :name="'animal-breed'" :label="'Race'" :options="$breeds"/>
                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <x-forms.input class="w-full" :type="'number'" :name="'animal-age'" :label="'Age'" :placeholder="2"/>
                    <x-forms.select :name="'animal-sexe'" :label="'Sexe'" :options="$sexes"/>
                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <x-forms.input class="w-full" :type="'text'" :name="'animal-coat'" :label="'Pelage'" :placeholder="'Doré'"/>
                    <x-forms.select :name="'animal-state'" :label="'Status'" :options="$statuses"
                                    :value="old('accepts-children')"/>

                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <x-forms.radio :name="'accepts-children'" :label="'Accepte les enfants'"/>
                    <x-forms.radio :name="'accepts-dogs'" :label="'Accepte les chiens'" :value="old('accepts-dogs')"/>
                    <x-forms.radio :name="'accepts-cats'" :label="'Accepte les chats'" :value="old('accepts-cats')"/>
                </div>
            </fieldset>
            <fieldset class="flex flex-col gap-6">
                <legend>
                    Descriptions & Notes
                </legend>
                <div class="border-t-2 border-t-main-blue pt-5">
                    <div class="flex gap-6">
                        <div class="flex w-full gap-2 flex-col">
                            <x-forms.textarea :name="'animal-description'" :label="'Description'" :placeholder="'Votre description ici...'"/>
                        </div>
                        <div class="flex w-full gap-2 flex-col">
                            <x-forms.textarea :name="'animal-description'" :label="'Notes'" :placeholder="'Ajouter votre note ici...'"/>
                        </div>
                    </div>
                </div>

            </fieldset>
            <x-forms.submit>
                Créer la fiche
            </x-forms.submit>
        </form>
    </x-admin.section>
</div>
