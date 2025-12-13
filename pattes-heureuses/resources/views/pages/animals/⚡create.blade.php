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
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {

    use WithFileUploads;
    public string $acceptChildren = '';
    public string $acceptDogs = '';
    public string $acceptCats = '';
    public string $description = '';
    public string $specieId = '';
    public Collection $species;
    public Collection $coats;
    public Collection $behaviors;
    public string $avatar = '';
    public string $name = '';
    public string $breed = '';
    public int $age;
    public SexeAnimal $sexe;
    public string $coat = '';
    public AnimalStatus $status;


    public function mount()
    {
        $this->species = Specie::all();
        $this->behaviors = Behavior::all();
        $this->coats = Coat::all();

    }

    #[Computed]
    public function breeds()
    {
        return Breed::where('specie_id', $this->specieId)->get();
    }

    public function create()
    {
        $new_animal = Animal::create([
            'name' => $this->name,
            'description' => $this->description,
            'sexe' => $this->sexe,
            'age' => $this->age,
            'state' => AnimalStatus::PENDING,
            'author' => auth()->user()->last_name . auth()->user()->first_name,
            'avatar' => $this->avatar,
            'accept_kids' => $this->acceptChildren,
            'accept_dogs' => $this->acceptDogs,
            'accept_cats' => $this->acceptCats,
            'breed_id' => $this->breed,
        ]);

        $new_animal->coats()->attach($this->coat);
        $new_animal->behaviors()->attach($this->coat);

        $this->redirect(route('animals-show', $new_animal));
    }
};
?>

<div class="flex flex-col gap-12">
    <x-admin.section :title="'Créer une nouvelle fiche'">
        <form action="#" wire:submit="create()" method="post"
              class="flex flex-col gap-12 border-2 border-main-blue rounded-lg p-6 bg-white">
            <fieldset class="flex flex-col gap-6">
                <legend>
                    Informations sur l'animal
                </legend>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between border-t-2 border-t-main-blue pt-5">
                    <x-forms.input class="w-full" wire:model.blur="avatar" :type="'file'" :name="'animal-avatar'"
                                   :label="'Photo'"/>
                    <x-forms.input class="w-full" wire:model.blur="name" :type="'text'" :name="'animal-name'"
                                   :label="'Nom'"
                                   :placeholder="'Peanut'"/>
                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <x-forms.select :name="'animal-type'" wire:model.blur="specieId" :label="'Type'"
                                    :options="$this->species">
                        <option selected disabled value="">--Selectionner une espèce--</option>
                    </x-forms.select>
                    <x-forms.select :name="'animal-breed'" wire:model.blur="breed" :label="'Race'"
                                    :options="$this->breeds">
                        <option selected disabled value="">--Selectionner une espèce--</option>

                    </x-forms.select>
                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <x-forms.input class="w-full" wire:model.blur="age" :type="'number'" :name="'animal-age'"
                                   :label="'Age'"
                                   :placeholder="2"/>
                    <x-forms.select :name="'animal-sexe'" wire:model.blur="sexe" :label="'Sexe'"
                                    :options="SexeAnimal::cases()">
                        <option selected disabled value="">--Selectionner un sexe--</option>
                    </x-forms.select>
                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <x-forms.select wire:model.blur="coat" :name="'animal-coat'" :label="'Pelage'"
                                    :options="$this->coats">
                        <option selected disabled value="">--Selectionner un pelage--</option>
                    </x-forms.select>

                    <x-forms.select :name="'animal-state'" wire:model="behaviors" :label="'Caractère'"
                                    :options="$this->behaviors">
                        <option selected disabled value="">--Selectionner un status--</option>
                    </x-forms.select>

                </div>
                <div class="flex flex-col gap-6 sm:flex-row sm:justify-between">
                    <x-forms.radio wire:model.blur="acceptChildren" :name="'accept-children'"
                                   :label="'Tolérance enfants'"/>
                    <x-forms.radio wire:model.blur="acceptDogs" :name="'accept-dogs'" :label="'Tolérance chiens'"/>
                    <x-forms.radio wire:model.blur="acceptCats" :name="'accept-cats'" :label="'Tolérance chats'"/>

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
