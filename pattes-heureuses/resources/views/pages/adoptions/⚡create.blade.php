<?php

use App\Enums\AdoptionStatus;
use App\Enums\AnimalStatus;
use App\Enums\SexeAnimal;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Behavior;
use App\Models\Breed;
use App\Models\Coat;
use App\Models\Specie;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {


    public string $selected_animal_id = '';
    public string $last_name = '';
    public string $first_name = '';
    public string $email = '';
    public string $telephone = '';
    public string $housing_type = '';
    public string $environment = '';
    public string $motivations = '';
    public Collection $animals;

    public function mount()
    {
        $this->animals = Animal::orderBy('name')->get();
    }


    #[Computed]
    public function selected_animal()
    {
        if (empty($this->selected_animal_id)) {
            return null;
        }
        return $this->animals->find($this->selected_animal_id);
    }

    public function rules()
    {
        return [
            'last_name' => 'required|min:3|max:100',
            'first_name' => 'required|min:3|max:100',
            'email' => 'required',
            'telephone' => 'nullable|regex:/^\+?[0-9 ]{10,15}$/',
            'housing_type' => 'nullable|max:100',
            'environment' => 'nullable|max:100',
            'motivations' => 'nullable|max:100',
            'selected_animal_id' => 'required',
        ];
    }

    public function create_adoption()
    {
        $validated = $this->validate();

        $new_adoption = Adoption::create([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'email' => $validated['email'],
            'status' => AdoptionStatus::Pending,
            'telephone' => $validated['telephone'],
            'housing_type' => $validated['housing_type'],
            'environment' => $validated['environment'],
            'motivations' => $validated['motivations'],
            'animal_id' => $validated['selected_animal_id']
        ]);

        return redirect()->to(route('adoptions-show', $new_adoption));


    }
};
?>


<div class="flex flex-col gap-12">

    <x-admin.section :title="'Adoption De'">
        <div class="flex flex-col gap-6 lg:grid lg:grid-cols-2">
            <form class="flex flex-col gap-8 p-6 border border-main-blue rounded-lg bg-white"
                 wire:submit="create_adoption">
                <fieldset class="flex flex-col gap-4">
                    <legend>
                        Informations personnelles
                    </legend>
                    <div class="flex flex-col gap-4 border-t-2 border-t-main-blue pt-5 lg:flex-row lg:justify-between">
                        <x-forms.input :name="'last_name'"
                                       :type="'text'"
                                       :label="'Nom'"
                                       :placeholder="'Doe'"
                                       wire:model.blur="last_name"
                                       :required="true">
                            <span
                                class="font-poppins text-red-600 font-semibold">@error('last_name') {{ $message }} @enderror
                            </span>
                        </x-forms.input>


                        <x-forms.input :name="'first_name'"
                                       :type="'text'"
                                       :label="'Prénom'"
                                       wire:model.blur="first_name"
                                       :placeholder="'John'"
                                       :required="true">
                            <span
                                class="font-poppins text-red-600 font-semibold">@error('first_name') {{ $message }} @enderror
                            </span>
                        </x-forms.input>
                    </div>
                    <div class="flex flex-col gap-4 lg:flex-row lg:justify-between">
                        <x-forms.input :name="'email'"
                                       :type="'email'"
                                       :label="'Email'"
                                       wire:model.blur="email"
                                       :placeholder="'john.doe@gmail.com'"
                                       :required="true">
                            <span
                                class="font-poppins text-red-600 font-semibold">@error('email') {{ $message }} @enderror
                            </span>
                        </x-forms.input>
                        <x-forms.input :name="'telephone'"
                                       :type="'tel'"
                                       :label="'Téléphone'"
                                       wire:model.blur="telephone"
                                       :placeholder="'0485 48 48 30'">
                            <span
                                class="font-poppins text-red-600 font-semibold">@error('telephone') {{ $message }} @enderror
                            </span>
                        </x-forms.input>
                    </div>
                </fieldset>
                <fieldset class="flex flex-col gap-4">
                    <legend>
                        Informations sur votre logement
                    </legend>
                    <div class="flex flex-col gap-4 border-t-2 border-t-main-blue pt-5 lg:flex-row lg:justify-between">
                        <x-forms.input :name="'housing_type'"
                                       :type="'text'"
                                       :label="'Type de logement'"
                                       wire:model.blur="housing_type"
                                       :placeholder="'Appartement'">
                            <span
                                class="font-poppins text-red-600 font-semibold">@error('housing_type') {{ $message }} @enderror
                            </span>
                        </x-forms.input>
                        <x-forms.input :name="'environment'"
                                       :type="'text'"
                                       :label="'Environnement'"
                                       wire:model.blur="environment"
                                       :placeholder="'Jardin / forêt'">
                            <span
                                class="font-poppins text-red-600 font-semibold">@error('environment') {{ $message }} @enderror
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
                            wire:model.blur="motivations"
                            :placeholder="'Je souhaite adopté Jean parce que je veux pouvoir lui donner un nouveaux foyer...'">
                            <span
                                class="font-poppins text-red-600 font-semibold">@error('motivations') {{ $message }} @enderror
                            </span>
                        </x-forms.textarea>
                    </div>
                </fieldset>
                <x-forms.submit>
                    Envoyer
                </x-forms.submit>

            </form>
            <div class="flex flex-col gap-2">
                <x-forms.select wire:model.live="selected_animal_id" :options="$this->animals" :sta :label="'Animal à adopter'"
                                :name="'select_animal'"
                :disabled="' Sélectionner un animal'">
                    <span
                        class="font-poppins text-red-600 font-semibold">@error('selected_animal_id') {{ $message }} @enderror
                    </span>
                </x-forms.select>



                @if($this->selected_animal)
                    @php
                        $profil = [
                            'name' => $this->selected_animal->name,
                            'type' => $this->selected_animal->breed->specie->name,
                            'breed' => $this->selected_animal->breed->name,
                            'age' => $this->selected_animal->age,
                            'coat' => $this->selected_animal->coats->pluck('name')->join(' / '),
                            'vaccin' => $this->selected_animal->vaccins->pluck('name')->join(' / ')
                            ];
                        $behavior = [
                            'behavior' => $this->selected_animal->behaviors->pluck('name')->join(' / '),
                            'accept_dogs' => $this->selected_animal->accept_dogs_label,
                            'accept_kids' => $this->selected_animal->accept_kids_label,
                            'accept_cats' => $this->selected_animal->accept_cats_label,
                            ]
                    @endphp

                    <x-cards.animal-data class="lg:col-span-5 lg:sticky lg:top-20 lg:right-0"
                                         :name="$this->selected_animal->name"
                                         :sexe="$this->selected_animal->sexe"
                                         :data_animals_profile="$profil"
                                         :data_animals_behavior="$behavior"
                    :state="$this->selected_animal->state">

                    </x-cards.animal-data>
                @endif

            </div>


        </div>

    </x-admin.section>

</div>




