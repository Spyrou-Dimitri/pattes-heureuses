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
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {

    use WithFileUploads;


    public $image;
    public AnimalStatus $status;
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
            'avatar' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,webp',
            'name' => 'required|min:3',
            'status' => ['required', Rule::enum(AnimalStatus::class)],
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
            'avatar.image' => 'Ceci n\'est pas une image',
            'avatar.max' => 'Taille d\'image trop grande',
            'avatar.mimes' => 'Ceci n\'est pas un type mime',
            'name.min' => ':attribute trop court (minimum 3 caractères).',
            'name.required' => 'Le :attribute est requis',
            'status.required' => 'Le :attribute est requis',
            'status.enum' => 'Le :attribute doit être une valeur valide',
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
            'status' => 'Status',
            'selectedSpecie' => 'espèce',
            'selectedBreed' => 'race',
            'age' => 'age',
            'sexe' => 'sexe',
            'selectedCoat' => 'pelage',
            'selectedBehavior' => 'caractère'
        ];
    }

    public function updatedSelectedBreed($value)
    {
        if ($value === 'new_breed') {
            $this->dispatch('open_modal', ['form' => 'modals::settings.breed.create']);
        }
    }

    public function updatedSelectedCoat($value)
    {
        if ($value === 'new_coat') {
            $this->dispatch('open_modal', ['form' => 'modals::settings.coat.create']);
        }
    }
    public function updatedSelectedBehavior($value)
    {
        if ($value === 'new_behavior') {
            $this->dispatch('open_modal', ['form' => 'modals::settings.behavior.create']);
        }
    }


    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function delete_img()
    {
        $this->reset('image');
    }

    public function create()
    {
        $this->validate();
        $new_animal = Animal::create([
            'name' => $this->name,
            'state' => $this->status,
            'description' => $this->description,
            'sexe' => $this->sexe,
            'age' => $this->age,
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
                <div
                    class="border-t-2 border-t-main-blue pt-5 flex flex-col justify-between lg:grid lg:grid-cols-12 lg:items-center lg:gap-x-16">
                    <div class="lg:col-span-4 flex flex-col gap-2 w-full relative">
                        <input wire:model="image" type="file" id="avatar" class="absolute inset-0 hidden" name="avatar">
                        <label for="avatar" class="flex flex-col gap-2 items-center">
                            <img
                                @if($this->image)
                                    src="{!! $this->image->temporaryUrl() !!}"

                                @else {
                                src="{{asset('icons/file.svg')}}"
                                }
                                @endif
                                alt="" class="img-type-file">

                            @if($this->image)
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
                            @if($this->image === null)
                                <span class="text-xl font-poppins">
                                Importer une image
                            </span>
                            @endif


                        </label>
                        <span
                            class="font-poppins text-red-600 font-semibold">@error('avatar') {{ $message }} @enderror
                    </span>
                    </div>
                    <div class="flex flex-col gap-6 lg:col-span-8">
                        <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                            <div class="flex flex-col gap-2 w-full">
                                <x-forms.input :required="true" class="w-full" wire:model.live="name" :type="'text'"
                                               :name="'animal-name'"
                                               :label="__('admin/animals/create.name')"
                                               :placeholder="'Peanut'"/>
                                <span
                                    class="font-poppins text-red-600 font-semibold">@error('name') {{ $message }} @enderror
                    </span>
                            </div>
                            <div class="flex flex-col gap-2 w-full">
                                <x-forms.select :required="true" wire:model.live="status"
                                                :options="AnimalStatus::cases()" class="w-full" :name="'animal-state'"
                                                :label="__('admin/animals/create.state')"
                                />
                                <span
                                    class="font-poppins text-red-600 font-semibold">@error('status') {{ $message }} @enderror
                    </span>
                            </div>
                        </div>
                        <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                            <div class="flex flex-col gap-2 w-full">
                                <x-forms.select :required="true" :name="'animal-type'" wire:model.live="selectedSpecie"
                                                :label="__('client/animals/show/show.type')"
                                                :options="$this->species">
                                    <option selected disabled
                                            value="">{{__('admin/animals/create.disabled_type')}}</option>
                                </x-forms.select>
                                <span class="font-poppins text-red-600 font-semibold">
                            @error('selectedSpecie') {{ $message }} @enderror
                        </span>
                            </div>
                            <div class="flex flex-col gap-2 w-full">
                                <x-forms.select required :name="'animal-breed'" wire:model.live="selectedBreed"
                                                :label="__('admin/animals/create.breed')"
                                                :options="$this->breeds">
                                    <option selected disabled
                                            value="">{{__('admin/animals/create.disabled_breed')}}</option>
                                    <option value="new_breed">Ajouter une nouvelle race</option>

                                </x-forms.select>
                                <span class="font-poppins text-red-600 font-semibold">
                            @error('selectedBreed') {{ $message }} @enderror
                        </span>
                            </div>
                        </div>
                        <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                            <div class="flex flex-col gap-2 w-full">
                                <x-forms.input :required="true" class="w-full" wire:model.live="age" :type="'number'"
                                               :name="'animal-age'"
                                               :label="__('admin/animals/create.age')"
                                               :placeholder="2"/>
                                <span class="font-poppins text-red-600 font-semibold">
                            @error('age') {{ $message }} @enderror
                        </span>
                            </div>
                            <div class="flex flex-col gap-2 w-full">
                                <x-forms.select :required="true" :name="'animal-sexe'" wire:model.live="sexe"
                                                :label="__('admin/animals/create.sexe')"
                                                :options="SexeAnimal::cases()">
                                    <option selected disabled
                                            value="">{{__('admin/animals/create.disabled_sexe')}}</option>
                                </x-forms.select>
                                <span class="font-poppins text-red-600 font-semibold">
                            @error('sexe') {{ $message }} @enderror
                        </span>
                            </div>
                        </div>
                        <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                            <div class="flex flex-col gap-2 w-full">
                                <x-forms.select :required="true" wire:model.live="selectedCoat" :name="'animal-coat'"
                                                :label="__('admin/animals/create.coat')"
                                                :options="$this->coats">
                                    <option selected disabled
                                            value="">{{__('admin/animals/create.disabled_coat')}}</option>
                                    <option value="new_coat">Ajouter un nouveau pelage</option>

                                </x-forms.select>
                                <span class="font-poppins text-red-600 font-semibold">
                            @error('selectedCoat') {{ $message }} @enderror
                        </span>
                            </div>
                            <div class="flex flex-col gap-2 w-full">
                                <x-forms.select :required="true" :name="'animal-state'" wire:model.live="selectedBehavior"
                                                :label="__('admin/animals/create.behavior')"
                                                :options="$this->behaviors">
                                    <option selected disabled
                                            value="">{{__('admin/animals/create.disabled_behavior')}}</option>
                                    <option value="new_behavior">Ajouter un nouveau caractère</option>

                                </x-forms.select>
                                <span class="font-poppins text-red-600 font-semibold">
                            @error('selectedBehavior') {{ $message }} @enderror
                        </span>
                            </div>
                        </div>
                        <div class="flex flex-col gap-6 sm:flex-row sm:flex-wrap sm:justify-between">
                            <div class="flex flex-col gap-2 w-fit">
                                <x-forms.radio :required="true" wire:model.live="acceptChildren"
                                               :name="'accept-children'"
                                               :label="__('admin/animals/create.accept_kids')"/>
                                <span class="font-poppins text-red-600 font-semibold">
                            @error('acceptChildren') {{ $message }} @enderror
                        </span>
                            </div>
                            <div class="flex flex-col gap-2 w-fit">
                                <x-forms.radio :required="true" wire:model.live="acceptDogs" :name="'accept-dogs'"
                                               :label="__('admin/animals/create.accept_dogs')"/>
                                <span class="font-poppins text-red-600 font-semibold">
                            @error('acceptDogs') {{ $message }} @enderror
                        </span>
                            </div>
                            <div class="flex flex-col gap-2 w-fit">
                                <x-forms.radio :required="true" wire:model.live="acceptCats" :name="'accept-cats'"
                                               :label="__('admin/animals/create.accept_cats')"/>
                                <span class="font-poppins text-red-600 font-semibold">
                            @error('acceptCats') {{ $message }} @enderror
                        </span>
                            </div>
                        </div>
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
                            <x-forms.textarea wire:model.live="description" :name="'animal-description'"
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
