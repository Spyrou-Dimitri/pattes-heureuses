<?php

use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Note;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public Adoption $adoption;

    public $adoption_notes;

    public array $adopter_profil_value = [];
    public array $adopter_place_value = [];
    public array $animal_profil_value;
    public array $animal_behavior_value;
    public ?string $motivations = null;

    public function mount($id)
    {

        $this->adoption = Adoption::findOrFail($id);
        $this->adopter_profil_value = [
            'last_name' => $this->adoption->last_name,
            'first_name' => $this->adoption->first_name,
            'email' => $this->adoption->email,
            'telephone' => $this->adoption->telephone,
        ];
        $this->adopter_place_value = [
            'housing_type' => $this->adoption->housing_type,
            'environment' => $this->adoption->environment,
        ];
        $this->animal_profil_value = [
            'name' => $this->adoption->animal->name,
            'type' => $this->adoption->animal->breed->specie->name,
            'breed' => $this->adoption->animal->breed->name,
            'age' => $this->adoption->animal->age,
            'coat' => $this->adoption->animal->coats->pluck('name')->join(' / '),
            'vaccin' => $this->adoption->animal->vaccins->pluck('name')->join(' / ')
        ];
        $this->animal_behavior_value = [
            'behavior' => $this->adoption->animal->behaviors->pluck('name')->join(' / '),
            'accept_dogs' => $this->adoption->animal->accept_dogs_label,
            'accept_kids' => $this->adoption->animal->accept_kids_label,
            'accept_cats' => $this->adoption->animal->accept_cats_label,
        ];
        $this->motivations = $this->adoption->motivations;
        $this->adoption_notes = $this->adoption->notes;

    }


    public function change_status()
    {
        $this->dispatch('open_modal', ['form' => 'modals::adoptions.change-status', 'model_id' => $this->adoption->id]);
    }

    public function add_note()
    {
        $this->dispatch('open_modal', ['form' => 'modals::notes.add_note', 'model_id' => $this->adoption->id, 'model_type' => Adoption::class]);

    }
    public function show_note($noteId)
    {
        $this->dispatch('open_modal', ['form' => 'modals::notes.show_note', 'model_id' => $noteId]);
    }

    #[On('refresh')]
    public function refresh_status()
    {
        $this->adoption = $this->adoption->fresh();
        $this->adoption->status = $this->adoption->status;
        $this->adoption_notes = $this->adoption->notes;
    }


};
?>

<div class="max-w-7xl mx-auto">
    <section class="flex flex-col gap-4">
        <div class="flex justify-between ">
            <h2 class="h2-section text-left">
                Adoption de {{$this->adoption->animal->name}}
            </h2>
            <button wire:click="change_status()"
                    class="cursor-pointer text-2xl rounded-lg gap-2 border-2 font-poppins flex flex-row items-center font-semibold py-2 px-3  {{$this->adoption->status->color()}}">
                <svg width="16" height="16" viewBox="0 0 10 10" aria-hidden="true">
                    <circle cx="5" cy="5" r="5" fill="currentColor"/>
                </svg>
                {{$this->adoption->status->label()}}
            </button>
        </div>
        <div class="flex w-full flex-col-reverse gap-6 lg:items-start lg:grid lg:grid-cols-2">
            <x-cards.adoption-data :title="'Animal'"
                                   :first_section="$this->animal_profil_value"
                                   :second_section="$this->animal_behavior_value"
                                   :id="$this->adoption->animal->id"
            />
            <x-cards.adoption-data :title="'Adopteur'"
                                   :first_section="$this->adopter_profil_value"
                                   :second_section="$this->adopter_place_value"
                                   :id="$this->adoption->id"
                                   :motivations="$this->motivations"
            />
        </div>
        <section class="flex flex-col bg-white border border-main-blue rounded-lg p-6 gap-4 mt-6">
            <div class="flex flex-wrap gap-2 items-center justify-between">
                <h3 class="h3-article">Notes du suivi</h3>
                <button wire:click="add_note()" class="cta-primary w-fit">Ajouter une note</button>
            </div>

            <ul class="flex flex-col gap-2">
                @forelse($this->adoption_notes as $note)
                    <li wire:click="show_note({{$note->id}})"
                        class="font-poppins flex items-center gap-3 hover:text-orange-cta px-3 py-2 rounded-lg cursor-pointer transition-all duration-300 hover:bg-orange-50 group">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-gray-300 group-hover:bg-orange-cta transition-colors"></span>
                        {{$note->title}}
                    </li>
                @empty
                    <p class="font-poppins">Aucune note de suivi</p>
                @endforelse
            </ul>
        </section>
    </section>


</div>
