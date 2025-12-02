<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>
@php

    $statuses = collect([
        (object)[ 'id' => 1, 'name' => 'Bénévole' ],
        (object)[ 'id' => 2, 'name' => 'Admin' ],

    ]);


        $sexes = collect([
            (object)[ 'id' => 1, 'name' => 'Homme' ],
            (object)[ 'id' => 2, 'name' => 'Femmme' ],
            (object)[ 'id' => 3, 'name' => 'Autre' ],
        ]);
 @endphp


<div>
    <x-admin.section :title="'Créer un nouveau profil'">
        <form action="#" method="post" class="flex flex-col gap-12 border-2 border-main-blue rounded-lg p-6 bg-white">
            <fieldset class="flex flex-col gap-6">
                <legend>
                    Informations sur le bénévole
                </legend>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between border-t-2 border-t-main-blue pt-5">
                    <x-forms.input class="w-full" :type="'file'" :name="'volunteer-avatar'" :label="'Photo'"/>
                    <x-forms.select :name="'volunteer-sexe'" :label="'Sexe'" :options="$sexes"/>
                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <x-forms.input class="w-full" :type="'text'" :name="'volunteer-first-name'" :label="'Nom'" :placeholder="'Doe'"/>
                    <x-forms.input class="w-full" :type="'text'" :name="'volunteer-last-name'" :label="'Prénom'" :placeholder="'John'"/>
                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <x-forms.input class="w-full" :type="'email'" :name="'volunteer-email'" :label="'Email'" :placeholder="'john.doe@gmail.com'"/>
                    <x-forms.input class="w-full" :type="'password'" :name="'volunteer-password'" :label="'Mot de passe'" :placeholder="'**********'"/>
                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <x-forms.input class="w-full" :type="'tel'" :name="'volunteer-telephone'" :label="'Téléphone'" :placeholder="'+32 6 12 34 56 78'"/>
                    <x-forms.select :name="'volunteer-state'" :label="'Status'" :options="$statuses"
                                    :value="old('accepts-children')"/>

                </div>
            </fieldset>
            <x-forms.submit>
                Créer la fiche
            </x-forms.submit>
        </form>
    </x-admin.section>

</div>
