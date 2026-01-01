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
            @if(session()->has('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded-lg text-center">
                    {{ session('success') }}
                </div>
            @else
                <form class="flex flex-col gap-8 p-6 border border-main-blue rounded-lg bg-white"
                      action="{{route('adoption.store')}}" method="POST">
                    @csrf
                    <input name="animal_id" type="hidden" label="Animal" value="{{$animal->id}}">
                    <fieldset class="flex flex-col gap-4">
                        <legend>
                            Informations personnelles
                        </legend>
                        <div
                            class="flex flex-col gap-4 border-t-2 border-t-main-blue pt-5 lg:flex-row lg:justify-between">
                            <x-forms.input :name="'last_name'"
                                           :type="'text'"
                                           :label="'Nom'"
                                           :placeholder="'Doe'"
                                           :required="true">
                            <span class="font-poppins font-bold text-red-600">
                                @error('last_name')
                                {{ $message }}
                                @enderror
                            </span>
                            </x-forms.input>


                            <x-forms.input :name="'first_name'"
                                           :type="'text'"
                                           :label="'Prénom'"
                                           :placeholder="'John'"
                                           :required="true">
                            <span class="font-poppins font-bold text-red-600">
                                @error('first_name')
                                {{ $message }}
                                @enderror
                            </span>
                            </x-forms.input>
                        </div>
                        <div class="flex flex-col gap-4 lg:flex-row lg:justify-between">
                            <x-forms.input :name="'email'"
                                           :type="'email'"
                                           :label="'Email'"
                                           :placeholder="'john.doe@gmail.com'"
                                           :required="true">
                            <span class="font-poppins font-bold text-red-600">
                                @error('email')
                                {{ $message }}
                                @enderror
                            </span>
                            </x-forms.input>
                            <x-forms.input :name="'telephone'"
                                           :type="'tel'"
                                           :label="'Téléphone'"
                                           :placeholder="'0485 48 48 30'">
                            <span class="font-poppins font-bold text-red-600">
                                @error('telephone')
                                {{ $message }}
                                @enderror
                            </span>
                            </x-forms.input>
                        </div>
                    </fieldset>
                    <fieldset class="flex flex-col gap-4">
                        <legend>
                            Informations sur votre logement
                        </legend>
                        <div
                            class="flex flex-col gap-4 border-t-2 border-t-main-blue pt-5 lg:flex-row lg:justify-between">
                            <x-forms.input :name="'housing_type'"
                                           :type="'text'"
                                           :label="'Type de logement'"
                                           :placeholder="'Appartement'">
                            <span class="font-poppins font-bold text-red-600">
                                @error('housing_type')
                                {{ $message }}
                                @enderror
                            </span>
                            </x-forms.input>
                            <x-forms.input :name="'environment'"
                                           :type="'text'"
                                           :label="'Environnement'"
                                           :placeholder="'Jardin / forêt'">
                            <span class="font-poppins font-bold text-red-600">
                                @error('environment')
                                {{ $message }}
                                @enderror
                            </span>
                            </x-forms.input>
                        </div>
                    </fieldset>
                    <fieldset class="flex flex-col gap-4">
                        <legend>
                            Expériences et motivations
                        </legend>
                        <div class="flex flex-col gap-4 border-t-2 border-t-main-blue pt-5">
                            <x-forms.textarea
                                :name="'motivations'"
                                :label="'Pourquoi souhaitez-vous adopter ?'"
                                :placeholder="'Je souhaite adopté Jean parce que je veux pouvoir lui donner un nouveaux foyer...'">
                            <span class="font-poppins font-bold text-red-600">
                                @error('motivations')
                                {{ $message }}
                                @enderror
                            </span>
                            </x-forms.textarea>
                        </div>
                    </fieldset>
                    <x-forms.submit>
                        Envoyer
                    </x-forms.submit>

                </form>
            @endif
        </div>
        <x-cards.animal-data class="lg:col-span-5 lg:sticky lg:top-20 lg:right-0"
                             :name="$animal->name"
                             :sexe="$animal->sexe"
                             :data_animals_profile="$profil"
                             :data_animals_behavior="$behavior">
        </x-cards.animal-data>
    </x-layouts.grid>


</x-layouts.section>

