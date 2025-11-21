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


<x-basics.section :py="'landing'" :bg="'paws'">
<x-basics.grid class="md:items-start lg:relative lg:grid lg:grid-cols-12">
    <div class="flex flex-col gap-4 md:gap-6 lg:col-span-7">
        <h2 class="h2-section">
            Adoption de <strong>Jean</strong>
        </h2>

        <p class="font-poppins">
            Remplissez ce formulaire avec soin afin que nous puissions organiser la rencontre et finaliser
            l’adoption dans les meilleures conditions.
        </p>

        <form class="flex flex-col gap-8">
            <fieldset class="flex flex-col gap-4">

                <legend>
                    Informations personnelles
                </legend>
                <div class="flex flex-col gap-4 border-t-2 border-t-main-blue pt-5 lg:flex-row lg:justify-between">
                    <x-basics.input :name="'last-name'"
                                    :type="'text'"
                                    :label="'Nom'"
                                    :placeholder="'Doe'">
                    </x-basics.input>
                    <x-basics.input :name="'first-name'"
                                    :type="'text'"
                                    :label="'Prénom'"
                                    :placeholder="'John'">

                    </x-basics.input>
                </div>
                <div class="flex flex-col gap-4 lg:flex-row lg:justify-between">
                    <x-basics.input :name="'email'"
                                    :type="'email'"
                                    :label="'Email'"
                                    :placeholder="'john.doe@gmail.com'">

                    </x-basics.input>
                    <x-basics.input :name="'telephone'"
                                    :type="'tel'"
                                    :label="'Téléphone'"
                                    :placeholder="'0485 48 48 30'">

                    </x-basics.input>
                </div>
            </fieldset>
            <fieldset class="flex flex-col gap-4">
                <legend>
                    Informations sur votre logement
                </legend>
                <div class="flex flex-col gap-4 border-t-2 border-t-main-blue pt-5 lg:flex-row lg:justify-between">
                    <x-basics.input :name="'housing'"
                                    :type="'text'"
                                    :label="'Type de logement'"
                                    :placeholder="'Appartement'">

                    </x-basics.input>
                    <x-basics.input :name="'environment'"
                                    :type="'text'"
                                    :label="'Environnement'"
                                    :placeholder="'Jardin / forêt'">

                    </x-basics.input>
                </div>
            </fieldset>
            <fieldset class="flex flex-col gap-4">
                <legend>
                    Expériences et motivations
                </legend>
                <div class="flex flex-col gap-4 border-t-2 border-t-main-blue pt-5">
                    <label class="block text-xl" for="experience_motivation">
                        Pourquoi souhaitez-vous adopter ?
                    </label>
                    <textarea
                        class="py-2.5 px-4 border-1 rounded-lg border-orange-cta"
                        rows="10"
                        name="experience_motivation" id="experience_motivation"
                        placeholder="Je souhaite adopté Jean parce que je veux pouvoir lui donner un nouveaux foyer...">
                    </textarea>
                </div>

            </fieldset>
            <button type="submit">
                Envoyer
            </button>

        </form>
    </div>
    <x-basics.animal-data class="lg:col-span-5 lg:sticky lg:top-20 lg:right-0"
                          :name="'Jean'"
                          :sexe="'male'"
                          :data_animals_profile="$profile"
                          :data_animals_behavior="$behavior">

    </x-basics.animal-data>
</x-basics.grid>



</x-basics.section>
