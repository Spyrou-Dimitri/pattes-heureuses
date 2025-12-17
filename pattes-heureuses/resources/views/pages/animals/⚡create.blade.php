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

    public bool $acceptChildren = false;
    public bool $acceptDogs = false;
    public bool $acceptCats = false;
    public string $description = '';
    public string $selectedSpecie = '';
    public Collection $species;
    public Collection $coats;
    public Collection $behaviors;
    public string $avatar = '';
    public string $name = '';
    public string $selectedBreed = '';
    public int $age;
    public SexeAnimal $sexe;
    public string $selectedCoat = '';
    public string $selectedBehavior = '';


    public function mount()
    {
        $this->species = Specie::all();
        $this->behaviors = Behavior::all();
        $this->coats = Coat::all();

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

    public function create()


    {
        $this->validate();

        $new_animal = Animal::create([
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

        $new_animal->coats()->attach($this->selectedCoat);
        $new_animal->behaviors()->attach($this->selectedBehavior);

        $this->redirect(route('animals-show', $new_animal));
    }
};
?>

<div class="flex flex-col gap-12">
    <x-admin.section :title="__('admin/animals/create.title')">
        <form action="#" wire:submit="create()" method="post"
              class="flex flex-col gap-12 border-2 border-main-blue rounded-lg p-6 bg-white">
            <fieldset class="flex flex-col gap-6">
                <legend>
                    {{__('admin/animals/create.legend')}}
                </legend>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between border-t-2 border-t-main-blue pt-5">
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.input class="w-full" wire:model.blur="avatar" :type="'file'" :name="'animal-avatar'"
                                       :label="__('admin/animals/create.avatar')"/>
                        <span
                            class="font-poppins text-red-600 font-semibold">@error('avatar') {{ $message }} @enderror
                    </span>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.input  :required="true" class="w-full" wire:model.blur="name" :type="'text'" :name="'animal-name'"
                                       :label="__('admin/animals/create.name')"
                                       :placeholder="'Peanut'"/>
                        <span
                            class="font-poppins text-red-600 font-semibold">@error('name') {{ $message }} @enderror
                    </span>
                    </div>
                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.select :required="true" :name="'animal-type'" wire:model.blur="selectedSpecie" :label="__('client/animals/show/show.type')"
                                        :options="$this->species">
                            <option selected disabled value="">{{__('admin/animals/create.disabled_breed')}}</option>
                        </x-forms.select>
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('selectedSpecie') {{ $message }} @enderror
                        </span>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.select required :name="'animal-breed'" wire:model.blur="selectedBreed" :label="__('admin/animals/create.breed')"
                                        :options="$this->breeds">
                            <option selected disabled value="">{{__('admin/animals/create.disabled_breed')}}</option>

                        </x-forms.select>
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('selectedBreed') {{ $message }} @enderror
                        </span>
                    </div>
                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.input :required="true" class="w-full" wire:model.blur="age" :type="'number'" :name="'animal-age'"
                                       :label="__('admin/animals/create.age')"
                                       :placeholder="2"/>
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('age') {{ $message }} @enderror
                        </span>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.select :required="true" :name="'animal-sexe'" wire:model.blur="sexe" :label="__('admin/animals/create.sexe')"
                                        :options="SexeAnimal::cases()">
                            <option selected disabled value="">{{__('admin/animals/create.disabled_sexe')}}</option>
                        </x-forms.select>
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('sexe') {{ $message }} @enderror
                        </span>
                    </div>
                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.select :required="true" wire:model.blur="selectedCoat" :name="'animal-coat'" :label="__('admin/animals/create.coat')"
                                        :options="$this->coats">
                            <option selected disabled value="">{{__('admin/animals/create.disabled_coat')}}</option>
                        </x-forms.select>
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('selectedCoat') {{ $message }} @enderror
                        </span>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.select :required="true" :name="'animal-state'" wire:model="selectedBehavior" :label="__('admin/animals/create.behavior')"
                                        :options="$this->behaviors">
                            <option selected disabled value="">{{__('admin/animals/create.disabled_behavior')}}</option>
                        </x-forms.select>
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('selectedBehavior') {{ $message }} @enderror
                        </span>
                    </div>
                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.radio :required="true" wire:model.blur="acceptChildren" :name="'accept-children'"
                                       :label="__('admin/animals/create.accept_kids')"/>
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('acceptChildren') {{ $message }} @enderror
                        </span>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.radio :required="true" wire:model.blur="acceptDogs" :name="'accept-dogs'" :label="__('admin/animals/create.accept_dogs')"/>
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('acceptDogs') {{ $message }} @enderror
                        </span>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <x-forms.radio :required="true" wire:model.blur="acceptCats" :name="'accept-cats'" :label="__('admin/animals/create.accept_cats')"/>
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('acceptCats') {{ $message }} @enderror
                        </span>
                    </div>
                </div>
            </fieldset>
            <fieldset class="flex flex-col gap-6">
                <legend>
                    {{__('admin/animals/create.title_desc')}}
                </legend>
                <div class="border-t-2 border-t-main-blue pt-5">
                    <div class="flex gap-6">
                        <div class="flex w-full gap-2 flex-col">
                            <x-forms.textarea wire:model.blur="description" :name="'animal-description'"
                                              :label="__('admin/animals/create.desc')"
                                              :placeholder="__('admin/animals/create.placerholder_desc')"/>
                        </div>
                    </div>
                </div>

            </fieldset>
            <x-forms.submit>
                {{__('admin/animals/create.submit')}}
            </x-forms.submit>
        </form>
    </x-admin.section>
</div>
