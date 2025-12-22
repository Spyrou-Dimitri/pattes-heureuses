
<x-layouts.section :py="'landing'" :bg="'paws'">
    <x-layouts.grid class="md:items-start lg:relative lg:grid lg:grid-cols-12">
        <div class="flex flex-col gap-4 md:gap-6 lg:col-span-7">
            <h2 class="h2-section">
                Adoption de <strong>{{$animal->name}}</strong>
            </h2>

            <p class="font-poppins">
                Remplissez ce formulaire avec soin afin que nous puissions organiser la rencontre et finaliser
                l’adoption dans les meilleures conditions.
            </p>
            <x-forms.form.adoption-form :animal_id="$animal->id" />

        </div>
        <x-cards.animal-data class="lg:col-span-5 lg:sticky lg:top-20 lg:right-0"
                             :name="$animal->name"
                             :sexe="$animal->sexe"
                             :data_animals_profile="$profil"
                             :data_animals_behavior="$behavior">

        </x-cards.animal-data>
    </x-layouts.grid>


</x-layouts.section>

