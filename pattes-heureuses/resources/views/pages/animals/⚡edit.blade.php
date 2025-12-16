<?php

use App\Enums\AnimalStatus;
use App\Enums\SexeAnimal;
use App\Enums\SexeVolunteer;
use App\Models\Animal;
use App\Models\Behavior;
use App\Models\Breed;
use App\Models\Coat;
use App\Models\Specie;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {

    use WithFileUploads;

    public Animal $animal;
    public bool $acceptChildren;
    public bool $acceptDogs;
    public bool $acceptCats;
    public string $description;
    public string $selectedSpecie;
    public Collection $species;
    public Collection $coats;
    public Collection $behaviors;
    public string $avatar;
    public string $name;
    public string $selectedBreed;
    public int $age;
    public SexeAnimal $sexe;
    public string $selectedCoat;
    public string $selectedBehavior;


    public function mount($id)
    {

        //Générations des selects
        $this->species = Specie::all();
        $this->behaviors = Behavior::all();
        $this->coats = Coat::all();

        //Génération des infos de l'animal courrant
        $this->animal = Animal::findOrFail($id);
        $this->acceptChildren = $this->animal->accept_kids;
        $this->acceptDogs = $this->animal->accept_dogs;
        $this->acceptCats = $this->animal->accept_cats;
        $this->description = $this->animal->description;
        $this->selectedSpecie = $this->animal->breed->specie->id;
        $this->avatar = $this->animal->avatar;
        $this->name = $this->animal->name;
        $this->selectedBreed = $this->animal->breed->id;
        $this->age = $this->animal->age;
        $this->sexe = $this->animal->sexe;
        $this->selectedCoat = $this->animal->coats->pluck('name');
        $this->selectedBehavior = $this->animal->behaviors->pluck('name');



    }

    #[Computed]
    public function breeds()
    {
        return Breed::where('specie_id', $this->selectedSpecie)->get();
    }

    //Remet la race à zéro si on change d'espèce
    public function updatedSelectedSpecie()
    {
        $this->selectedBreed = '';
    }


    //Créer les règles de validation
    protected function rules()
    {
        return [
            'name' => 'required|min:3',
            'selectedSpecie' => 'required|exists:species,id',
            'selectedBreed' => ['required',
                Rule::exists('breeds', 'id')->where(fn($breedToSpecie) => $breedToSpecie->where('specie_id', $this->selectedSpecie))],
            'age' => ['required', 'integer', 'min:0'],
            'sexe' => ['required', Rule::enum(SexeAnimal::class)],
            'selectedCoat' => ['required', 'exists:coats,id'],
            'selectedBehavior' => ['required', 'exists:behaviors,id'],
            'acceptChildren' => ['required', 'boolean'],
            'acceptDogs' => ['required', 'boolean'],
            'acceptCats' => ['required', 'boolean'],
        ];
    }

    //Messages d'erreur
    protected function messages()
    {
        return [
            'name.min' => ':attribute trop court (minimum 3 caractères).',
            'name.required' => 'Le :attribute est requis',
            'selectedSpecie.exists' => 'L\':attribute n\'est pas référencée dans notre base de données',
            'selectedSpecie.required' => 'L\':attribute est requise',
            'selectedBreed.exists' => 'La :attribute n\'est pas référencée dans notre base de données',
            'selectedBreed.required' => 'La :attribute est requise',
            'age.required' => 'L\':attribute est requis',
            'age.integer' => 'L\':attribute doit être un nombre',
            'age.min' => 'L\':attribute doit être supérieur à 0',
            'sexe.required' => 'Le :attribute est requis',
            'sexe.enum' => 'Le :attribute doit être une valeur valide',
            'selectedCoat.exists' => 'Le :attribute est requis',
            'selectedCoat.required' => 'Le :attribute doit être une valeur valide',
            'selectedBehavior.exists' => 'Le :attribute est requis',
            'selectedBehavior.required' => 'Le :attribute doit être une valeur valide',
            'acceptChildren.boolean' => 'Veuillez indiquer si l’animal accepte les enfants.',
            'acceptDogs.boolean' => 'Veuillez indiquer si l’animal accepte les chiens.',
            'acceptCats.boolean' => 'Veuillez indiquer si l’animal accepte les chats.',
        ];
    }

    //Remplacer le wire:model par un nom plus humain dans le message d'erreur
    protected function validationAttributes()
    {
        return [
            'name' => 'nom',
            'selectedSpecie' => 'espèce',
            'selectedBreed' => 'race',
            'age' => 'age',
            'sexe' => 'sexe',
            'selectedCoat' => 'pelage',
            'selectedBehavior' => 'caractère'
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function update_animal()
    {
        $this->validate();

        $this->animal->update([
            'name' => $this->name,
            'description' => $this->description,
            'sexe' => $this->sexe,
            'age' => $this->age,
            'state' => AnimalStatus::PENDING,
            'author' => auth()->user()->last_name . ' ' . auth()->user()->first_name,
            'avatar' => $this->avatar,
            'accept_kids' => $this->acceptChildren,
            'accept_dogs' => $this->acceptDogs,
            'accept_cats' => $this->acceptCats,
            'breed_id' => $this->selectedBreed,
        ]);

        $this->animal->coats()->attach($this->selectedCoat);
        $this->animal->behaviors()->attach($this->selectedBehavior);

        $this->redirect(route('animals-show', $this->animal->id));
        session()->flash('success', 'Animal modifié avec succès !');

    }
};
?>

<div class="flex flex-col gap-12">
    <x-admin.section :title="'Modification de la fiche'">
        <form action="#" wire:submit="update_animal()" method="post"
              class="flex flex-col gap-12 border-2 border-main-blue rounded-lg p-6 bg-white">
            <fieldset class="flex flex-col gap-6">
                <legend>
                    Informations sur l'animal
                </legend>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between border-t-2 border-t-main-blue pt-5">
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.input class="w-full" wire:model.blur="avatar" :type="'file'" :name="'animal-avatar'"
                                       :label="'Photo'"/>
                        <span
                            class="font-poppins text-red-600 font-semibold">@error('avatar') {{ $message }} @enderror
                    </span>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.input  :required="true" class="w-full" wire:model.blur="name" :type="'text'" :name="'animal-name'"
                                       :label="'Nom'"
                                       :placeholder="'Peanut'"/>
                        <span
                            class="font-poppins text-red-600 font-semibold">@error('name') {{ $message }} @enderror
                    </span>
                    </div>
                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.select :required="true" :name="'animal-type'" wire:model.blur="selectedSpecie" :label="'Type'"
                                        :options="$this->species">
                            <option selected disabled value="">--Selectionner une espèce--</option>
                        </x-forms.select>
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('selectedSpecie') {{ $message }} @enderror
                        </span>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.select required :name="'animal-breed'" wire:model.blur="selectedBreed" :label="'Race'"
                                        :options="$this->breeds">
                            <option selected disabled value="">--Selectionner une espèce--</option>

                        </x-forms.select>
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('selectedBreed') {{ $message }} @enderror
                        </span>
                    </div>
                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.input :required="true" class="w-full" wire:model.blur="age" :type="'number'" :name="'animal-age'"
                                       :label="'Age'"
                                       :placeholder="2"/>
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('age') {{ $message }} @enderror
                        </span>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.select :required="true" :name="'animal-sexe'" wire:model.blur="sexe" :label="'Sexe'"
                                        :options="SexeAnimal::cases()">
                            <option selected disabled value="">--Selectionner un sexe--</option>
                        </x-forms.select>
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('sexe') {{ $message }} @enderror
                        </span>
                    </div>
                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.select :required="true" wire:model.blur="selectedCoat" :name="'animal-coat'" :label="'Pelage'"
                                        :options="$this->coats">
                            <option selected disabled value="">--Selectionner un pelage--</option>
                        </x-forms.select>
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('selectedCoat') {{ $message }} @enderror
                        </span>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.select :required="true" :name="'animal-state'" wire:model="selectedBehavior" :label="'Caractère'"
                                        :options="$this->behaviors">
                            <option selected disabled value="">--Selectionner un status--</option>
                        </x-forms.select>
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('selectedBehavior') {{ $message }} @enderror
                        </span>
                    </div>
                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.radio :required="true" wire:model.blur="acceptChildren" :name="'accept-children'"
                                       :label="'Tolérance enfants'"/>
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('acceptChildren') {{ $message }} @enderror
                        </span>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.radio :required="true" wire:model.blur="acceptDogs" :name="'accept-dogs'" :label="'Tolérance chiens'"/>
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('acceptDogs') {{ $message }} @enderror
                        </span>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.radio :required="true" wire:model.blur="acceptCats" :name="'accept-cats'" :label="'Tolérance chats'"/>
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('acceptCats') {{ $message }} @enderror
                        </span>
                    </div>
                </div>
            </fieldset>
            <fieldset class="flex flex-col gap-6">
                <legend>
                    Descriptions & Notes
                </legend>
                <div class="border-t-2 border-t-main-blue pt-5">
                    <div class="flex gap-6">
                        <div class="flex w-full gap-2 flex-col">
                            <x-forms.textarea wire:model.blur="description" :name="'animal-description'"
                                              :label="'Description'"
                                              :placeholder="'Votre description ici...'"/>
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
