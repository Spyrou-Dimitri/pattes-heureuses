@php
    $profile = [
            'type' => 'Chien',
            'breed' => 'Golden Retriever',
            'year' => '2 ans',
            'skin' => 'Doré',
        ];

        $behavior = [
            'behavior' => 'Malicieux / Sympa / Gentil',
            'place' => 'Tous',
            'accept_cats' => 'Oui',
            'accept_dogs' => 'Non',
            'accept_kids' => 'Non',
        ];
@endphp


<x-layouts.section :py="'landing'" :bg="'paws'">
<x-layouts.grid class="md:items-start lg:relative lg:grid lg:grid-cols-12">
    <div class="flex flex-col gap-4 md:gap-6 lg:col-span-7">
        <h2 class="h2-section">
            Adoption de <strong>Jean</strong>
        </h2>

        <p class="font-poppins">
            Remplissez ce formulaire avec soin afin que nous puissions organiser la rencontre et finaliser
            l’adoption dans les meilleures conditions.
        </p>

        <form class="flex flex-col gap-8" action="" method="POST">
            <fieldset class="flex flex-col gap-4">

                <legend>
                    Informations personnelles
                </legend>
                <div class="flex flex-col gap-4 border-t-2 border-t-main-blue pt-5 lg:flex-row lg:justify-between">
                    <x-forms.input :name="'last-name'"
                                    :type="'text'"
                                    :label="'Nom'"
                                    :placeholder="'Doe'">
                    </x-forms.input>
                    <x-forms.input :name="'first-name'"
                                    :type="'text'"
                                    :label="'Prénom'"
                                    :placeholder="'John'">

                    </x-forms.input>
                </div>
                <div class="flex flex-col gap-4 lg:flex-row lg:justify-between">
                    <x-forms.input :name="'email'"
                                    :type="'email'"
                                    :label="'Email'"
                                    :placeholder="'john.doe@gmail.com'">

                    </x-forms.input>
                    <x-forms.input :name="'telephone'"
                                    :type="'tel'"
                                    :label="'Téléphone'"
                                    :placeholder="'0485 48 48 30'">

                    </x-forms.input>
                </div>
            </fieldset>
            <fieldset class="flex flex-col gap-4">
                <legend>
                    Informations sur votre logement
                </legend>
                <div class="flex flex-col gap-4 border-t-2 border-t-main-blue pt-5 lg:flex-row lg:justify-between">
                    <x-forms.input :name="'housing'"
                                    :type="'text'"
                                    :label="'Type de logement'"
                                    :placeholder="'Appartement'">

                    </x-forms.input>
                    <x-forms.input :name="'environment'"
                                    :type="'text'"
                                    :label="'Environnement'"
                                    :placeholder="'Jardin / forêt'">

                    </x-forms.input>
                </div>
            </fieldset>
            <fieldset class="flex flex-col gap-4">
                <legend>
                    Expériences et motivations
                </legend>
                <div class="flex flex-col gap-4 border-t-2 border-t-main-blue pt-5">
                    <x-forms.textarea
                    :name="'experience_motivation'"
                    :label="'Pourquoi souhaitez-vous adopter ?'"
                    :placeholder="'Je souhaite adopté Jean parce que je veux pouvoir lui donner un nouveaux foyer...'">

                    </x-forms.textarea>
                </div>

            </fieldset>
            <x-forms.submit>

            </x-forms.submit>

        </form>
    </div>
    <x-cards.animal-data class="lg:col-span-5 lg:sticky lg:top-20 lg:right-0"
                          :name="'Jean'"
                          :sexe="'male'"
                          :data_animals_profile="$profile"
                          :data_animals_behavior="$behavior">

    </x-cards.animal-data>
</x-layouts.grid>



</x-layouts.section>

