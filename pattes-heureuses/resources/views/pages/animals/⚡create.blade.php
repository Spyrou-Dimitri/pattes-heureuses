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
use App\Models\SpecieVaccin;
use App\Models\Vaccin;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {

    use WithFileUploads;

    public array $selectedVaccins = [];
    public array $selectedCoat = [];
    public array $selectedBehavior = [];
    public $avatar;
    public AnimalStatus $status;
    public bool $acceptChildren = false;
    public bool $acceptDogs = false;
    public bool $acceptCats = false;
    public string $description = '';
    public string $selectedSpecie = '';
    public Collection $species;
    public Collection $coats;
    public Collection $behaviors;
    public string $name = '';
    public string $selectedBreed = '';
    public int $age;
    public SexeAnimal $sexe;


    public function mount()
    {
        $this->species = Specie::all();
        $this->behaviors = Behavior::all();
        $this->coats = Coat::all();
    }

    #[Computed]
    public function allowedStatusOfUser() {
        if (auth()->user()->isVolunteer()) {
            return [AnimalStatus::PENDING];
        }

        return AnimalStatus::cases();
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


    //Remet la race à zéro si je change d'espèce
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
            'description' => 'nullable|string',
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
            'selectedVaccins' => ['required', 'exists:vaccins,id']

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
            'selectedBehavior' => 'caractère',
            'selectedVaccins' => 'vaccin',
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



    #[On('list_changed')]
    public function reset_list()
    {
        unset($this->breeds);
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    //Fonctionne pas
    public function delete_img()
    {
        $this->reset('avatar');
    }

    public function create()
    {
        $validated = $this->validate();
        if (auth()->user()->isVolunteer()) {
            $validated['status'] = AnimalStatus::PENDING;
        }
        if ($validated['avatar']) {
            $new_original_file_name = uniqid() . '.' . config('animalavatars.image_type');
            $full_path_to_original = Storage::putFileAs(
                config('animalavatars.original_path'),
                $validated['avatar'],
                $new_original_file_name
            );
            if ($full_path_to_original) {
                $validated['avatar'] = $new_original_file_name;
                ProcessUploadedImageJob::dispatchSync($full_path_to_original, $new_original_file_name);
            } else {
                $validated['avatar'] = '';
            }
        }

        $new_animal = Animal::create([
            'name' => $validated['name'],
            'state' => $validated['status'],
            'description' => $validated['description'],
            'sexe' => $validated['sexe'],
            'age' => $validated['age'],
            'author' => auth()->user()->last_name . ' ' . auth()->user()->first_name,
            'avatar' => $validated['avatar'],
            'accept_kids' => $validated['acceptChildren'],
            'accept_dogs' => $validated['acceptDogs'],
            'accept_cats' => $validated['acceptCats'],
            'breed_id' => $validated['selectedBreed'],
        ]);

        $new_animal->coats()->attach($validated['selectedCoat']);
        $new_animal->behaviors()->attach($validated['selectedBehavior']);
        $new_animal->vaccins()->attach($validated['selectedVaccins']);

        return redirect()->to(route('animals-show', $new_animal));
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
                <div class="border-t-2 border-t-main-blue pt-5 flex flex-col justify-between lg:grid lg:grid-cols-12 lg:items-center lg:gap-x-16">
                    <div class="lg:col-span-4 flex flex-col gap-2 w-full relative">
                        <input wire:model="avatar" type="file" id="avatar" class="absolute inset-0 hidden"
                               name="avatar">
                        <label for="avatar" class="cursor-pointer flex flex-col gap-2 items-center">
                            <img
                                @if($this->avatar)
                                    src="{!! $this->avatar->temporaryUrl() !!}"

                                @else {
                                src="{{asset('icons/file.svg')}}"
                                }
                                @endif
                                alt="" class="img-type-file">

                            @if($this->avatar)
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
                            @if($this->avatar === null)
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
                            <x-forms.input :required="true" class="w-full" wire:model.live="name" :type="'text'"
                                           :name="'animal-name'"
                                           :label="__('admin/animals/create.name')"
                                           :placeholder="'Peanut'">
                                    <span
                                        class="font-poppins text-red-600 font-semibold">@error('name') {{ $message }} @enderror
                                    </span>
                            </x-forms.input>
                            <x-forms.input :required="true" class="w-full" wire:model.live="age" :type="'number'"
                                           :name="'animal-age'"
                                           :label="__('admin/animals/create.age')"
                                           :placeholder="2">
                                    <span class="font-poppins text-red-600 font-semibold">
                                        @error('age') {{ $message }} @enderror
                                    </span>
                            </x-forms.input>
                        </div>
                        <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                            <x-forms.select :required="true" :name="'animal-type'" wire:model.live="selectedSpecie"
                                            :label="__('client/animals/show/show.type')"
                                            :options="$this->species"
                                            :disabled="__('admin/animals/create.disabled_type')">
                                <span class="font-poppins text-red-600 font-semibold">
                                    @error('selectedSpecie') {{ $message }} @enderror
                                </span>
                            </x-forms.select>
                            <x-forms.select required :name="'animal-breed'" wire:model.live="selectedBreed"
                                            :label="__('admin/animals/create.breed')"
                                            :options="$this->breeds"
                                            :disabled="__('admin/animals/create.disabled_breed')"
                                            :new_instance="true"
                                            :new_instance_value="'new_breed'"
                                            :new_instance_label="'Ajouter une nouvelle espèce'">
                                <span class="font-poppins text-red-600 font-semibold">
                                    @error('selectedBreed') {{ $message }} @enderror
                                </span>
                            </x-forms.select>

                        </div>
                        <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                            <x-forms.select :required="true" wire:model.live="status"
                                            :options="$this->allowedStatusOfUser" class="w-full" :name="'animal-state'"
                                            :label="__('admin/animals/create.state')"
                                            :disabled="__('admin/animals/create.disabled_state')"
                            >
                                <span
                                    class="font-poppins text-red-600 font-semibold">@error('status') {{ $message }} @enderror
                                </span>
                            </x-forms.select>

                                <x-forms.select :required="true" :name="'animal-sexe'" wire:model.live="sexe"
                                                :label="__('admin/animals/create.sexe')"
                                                :options="SexeAnimal::cases()"
                                                :disabled="__('admin/animals/create.disabled_sexe')">
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
                            @error('selectedBehavior') {{ $message }} @enderror
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
