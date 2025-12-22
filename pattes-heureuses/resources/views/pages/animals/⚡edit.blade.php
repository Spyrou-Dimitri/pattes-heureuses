<?php

use App\Enums\AnimalStatus;
use App\Enums\SexeAnimal;
use App\Enums\SexeVolunteer;
use App\Jobs\ProcessUploadedImageJob;
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
    public array $selectedVaccins = [];
    public bool $acceptChildren;
    public bool $acceptDogs;
    public bool $acceptCats;
    public string $description;
    public string $selectedSpecie;
    public Collection $species;
    public Collection $coats;
    public Collection $behaviors;
    public $new_avatar = null;
    public $avatar;
    public string $name;
    public string $selectedBreed;
    public int $age;
    public AnimalStatus $status;
    public SexeAnimal $sexe;
    public array $selectedCoat = [];
    public array $selectedBehavior = [];


    public function mount($id)
    {

        //Générations des select
        $this->species = Specie::all();
        $this->behaviors = Behavior::all();
        $this->coats = Coat::all();

        //Génération des infos de l'animal courrant
        $this->animal = Animal::findOrFail($id);
        $this->selectedVaccins = $this->animal->vaccins->pluck('id')->toArray();
        $this->selectedCoat = $this->animal->coats->pluck('id')->toArray();
        $this->selectedBehavior = $this->animal->behaviors->pluck('id')->toArray();
        $this->acceptChildren = $this->animal->accept_kids;
        $this->acceptDogs = $this->animal->accept_dogs;
        $this->acceptCats = $this->animal->accept_cats;
        $this->description = $this->animal->description;
        $this->status = $this->animal->state;
        $this->selectedSpecie = $this->animal->breed->specie->id;
        $this->avatar = $this->animal->avatar;
        $this->name = $this->animal->name;
        $this->selectedBreed = $this->animal->breed->id;
        $this->age = $this->animal->age;
        $this->sexe = $this->animal->sexe;


    }

    #[Computed]
    public function breeds()
    {
        return Breed::where('specie_id', $this->selectedSpecie)->get();
    }

    #[Computed]
    public function getVaccins()
    {
        if (!$this->selectedSpecie) {
            return collect();
        }
        return Specie::find($this->selectedSpecie)->vaccins;
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
            'description' => 'nullable',
            'selectedBreed' => ['required',
                Rule::exists('breeds', 'id')->where(fn($breedToSpecie) => $breedToSpecie->where('specie_id', $this->selectedSpecie))],
            'age' => ['required', 'integer', 'min:0'],
            'new_avatar' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,webp',
            'status' => ['required', Rule::enum(AnimalStatus::class)],
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
        $validated = $this->validate();
        $avatarPath = $this->animal->avatar;
        if (!empty($validated['new_avatar'])) {
            $avatarPath = uniqid() . '.' . config('animalavatars.image_type');
            $fullPath = Storage::putFileAs(
                config('animalavatars.original_path'),
                $validated['new_avatar'],
                $avatarPath
            );
            if ($fullPath) {
                ProcessUploadedImageJob::dispatchSync($fullPath, $avatarPath);
            }
        }

        $this->animal->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'sexe' => $validated['sexe'],
            'age' => $validated['age'],
            'state' => $validated['status'],
            'avatar' => $avatarPath,
            'accept_kids' => $validated['acceptChildren'],
            'accept_dogs' => $validated['acceptDogs'],
            'accept_cats' => $validated['acceptCats'],
            'breed_id' => $validated['selectedBreed'],
        ]);

        $this->animal->coats()->sync($this->selectedCoat);
        $this->animal->behaviors()->sync($this->selectedBehavior);
        $this->animal->vaccins()->sync($this->selectedVaccins);
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
                <div class="border-t-2 border-t-main-blue pt-5 flex flex-col justify-between lg:grid lg:grid-cols-12 lg:items-center lg:gap-x-16">
                    <div class="lg:col-span-4 flex flex-col gap-2 w-full relative">
                        <input wire:model="new_avatar" type="file" id="avatar" class="absolute inset-0 hidden"
                               name="avatar">
                        <label for="avatar" class="cursor-pointer flex flex-col gap-2 items-center">
                            @if($this->new_avatar)
                                <img src="{!! $this->new_avatar->temporaryUrl() !!}" alt="" class="img-type-file">

                            @else
                                <img src="{{asset('upload_img/animals/originals/' . $this->avatar)}}" alt=""
                                     class="img-type-file">
                            @endif

                            @if($this->new_avatar)
                                <button href="#"
                                        wire:click.prevent="delete_img()"
                                        x-data="{hover : false}"
                                        @mouseenter="hover = true"
                                        @mouseleave="hover = false"
                                        class="bg-red-600 cursor-pointer absolute -top-[14px] -right-[14px] border-2 border-red-600 hover:bg-white duration-300 hover:duration-300 p-1 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                         x-bind:fill="hover ? '#E7000B' : 'white'"
                                         viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                              d="M5.293 5.293a1 1 0 0 1 1.414 0L12 10.586l5.293-5.293a1 1 0 1 1 1.414 1.414L13.414 12l5.293 5.293a1 1 0 0 1-1.414 1.414L12 13.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L10.586 12 5.293 6.707a1 1 0 0 1 0-1.414Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            @endif

                        </label>
                        <span
                            class="font-poppins text-red-600 font-semibold">@error('avatar') {{ $message }} @enderror
                        </span>
                    </div>
                    <div class="flex flex-col gap-6 lg:col-span-8">
                        <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                            <x-forms.input :required="true" class="w-full" wire:model.blur="name" :type="'text'"
                                           :name="'animal-name'"
                                           :label="'Nom'"
                                           :placeholder="'Peanut'">
                            <span
                                class="font-poppins text-red-600 font-semibold">@error('name') {{ $message }} @enderror
                            </span>
                            </x-forms.input>
                            <x-forms.input :required="true" class="w-full" wire:model.blur="age" :type="'number'"
                                           :name="'animal-age'"
                                           :label="'Age'"
                                           :placeholder="2">
                            <span class="font-poppins text-red-600 font-semibold">
                                @error('age') {{ $message }} @enderror
                            </span>
                            </x-forms.input>
                        </div>
                        <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                            <x-forms.select :required="true" :name="'animal-type'" wire:model.blur="selectedSpecie"
                                            :label="'Type'"
                                            :options="$this->species"
                                            :disabled="'--Sélectionner une espèce--'">
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('selectedSpecie') {{ $message }} @enderror
                        </span>
                            </x-forms.select>
                            <x-forms.select required :name="'animal-breed'" wire:model.blur="selectedBreed"
                                            :label="'Race'"
                                            :options="$this->breeds"
                                            :disabled="'--Sélectionner une espèce--'">
                            <span class="font-poppins text-red-600 font-semibold">
                            @error('selectedBreed') {{ $message }} @enderror
                        </span>
                            </x-forms.select>
                        </div>
                        <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                            <x-forms.select :required="true"
                                            :name="'animal-status'"
                                            wire:model.blur="status"
                                            :label="'Status'"
                                            :options="AnimalStatus::cases()"
                                            :disabled="'--Selectionner un status--'">

                                <span class="font-poppins text-red-600 font-semibold">
                                    @error('status') {{ $message }} @enderror
                                </span>
                            </x-forms.select>
                            <x-forms.select :required="true" :name="'animal-sexe'" wire:model.blur="sexe"
                                            :label="'Sexe'"
                                            :options="SexeAnimal::cases()"
                                            :disabled="'--Selectionner un sexe--'">
                            <span class="font-poppins text-red-600 font-semibold">
                            @error('sexe') {{ $message }} @enderror
                        </span>
                            </x-forms.select>

                        </div>
                        <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                            <div class="flex flex-col gap-2 w-full">
                                <livewire:livewire.select wire:model="selectedCoat"
                                                          wire:key="coat-selected"
                                                          :name="__('admin/animals/create.coat')"
                                                          :disabled="__('admin/animals/create.disabled_coat')"
                                                          :models="Coat::all()"/>
                                <span class="font-poppins text-red-600 font-semibold">
                                    @error('selectedCoat') {{ $message }} @enderror
                                </span>
                            </div>
                            <div class="flex flex-col gap-2 w-full">
                                <livewire:livewire.select wire:model="selectedBehavior"
                                                          wire:key="behavior-selected"
                                                          :name="__('admin/animals/create.behavior')"
                                                          :disabled="__('admin/animals/create.disabled_behavior')"
                                                          :models="Behavior::all()"/>
                                <span class="font-poppins text-red-600 font-semibold">
                                    @error('selectedCoat') {{ $message }} @enderror
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                            <div class="flex flex-col gap-2 w-full">
                                <livewire:livewire.select
                                    wire:key="vaccins-select-{{ $selectedSpecie }}"
                                    wire:model="selectedVaccins"
                                    :name="__('admin/animals/create.vaccines')"
                                    :disabled="__('admin/animals/create.disabled_vaccines')"
                                    :models="$this->getVaccins"/>
                                <span class="font-poppins text-red-600 font-semibold">
                                    @error('selectedVaccins') {{ $message }} @enderror
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                            <x-forms.radio :required="true" wire:model.blur="acceptChildren" :name="'accept-children'"
                                           :label="'Tolérance enfants'">
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('acceptChildren') {{ $message }} @enderror
                        </span>
                            </x-forms.radio>
                            <x-forms.radio :required="true" wire:model.blur="acceptDogs" :name="'accept-dogs'"
                                           :label="'Tolérance chiens'">
                            <span class="font-poppins text-red-600 font-semibold">
                                @error('acceptDogs') {{ $message }} @enderror
                            </span>
                            </x-forms.radio>
                            <x-forms.radio :required="true" wire:model.blur="acceptCats" :name="'accept-cats'"
                                           :label="'Tolérance chats'">
                        <span class="font-poppins text-red-600 font-semibold">
                            @error('acceptCats') {{ $message }} @enderror
                        </span>
                            </x-forms.radio>
                        </div>
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
                Modifier la fiche
            </x-forms.submit>
        </form>
    </x-admin.section>
</div>
