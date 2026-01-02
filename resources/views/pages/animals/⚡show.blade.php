<?php

use App\Models\Animal;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public $animal;
    public $animal_profil_value;
    public $animal_behavior_value;
    public $animal_notes;

    public function mount($id)
    {
        $this->animal = Animal::findOrFail($id);
        $this->animal_profil_value = [
            'name' => $this->animal->name,
            'type' => $this->animal->breed->specie->name,
            'breed' => $this->animal->breed->name,
            'age' => $this->animal->age,
            'coat' => $this->animal->coats->pluck('name')->join(' / '),
            'vaccin' => $this->animal->vaccins->pluck('name')->join(' / ')
        ];
        $this->animal_behavior_value = [
            'behavior' => $this->animal->behaviors->pluck('name')->join(' / '),
            'accept_dogs' => $this->animal->accept_dogs_label,
            'accept_kids' => $this->animal->accept_kids_label,
            'accept_cats' => $this->animal->accept_cats_label,
        ];
        $this->animal_notes = $this->animal->notes;
    }

    public function change_status()
    {
        $this->dispatch('open_modal', ['form' => 'modals::animals.change-status', 'model_id' => $this->animal->id]);
    }

    public function add_note()
    {
        $this->dispatch('open_modal', ['form' => 'modals::notes.add_note', 'model_id' => $this->animal->id, 'model_type' => Animal::class]);

    }

    public function show_note($noteId)
    {
        $this->dispatch('open_modal', ['form' => 'modals::notes.show_note', 'model_id' => $noteId]);
    }

    #[On('refresh')]
    public function refresh_status()
    {
        $this->animal = $this->animal->fresh();
        $this->animal_notes = $this->animal->notes;
    }
};
?>

<div class="max-w-7xl mx-auto">
    <x-admin.section :title="'Fiche de' . ' ' . $this->animal->name"
                     :align="true">

        <div class="flex w-full flex-col gap-6 lg:grid lg:grid-cols-12 lg:items-start">
            <div class="lg:col-span-6"
            >
                @if(str_starts_with($this->animal->avatar, 'public/img/animal/'))
                    <img src="{{asset(str_replace('public/', '', $this->animal->avatar))}}"
                         alt="Photo de {{$this->animal->name}}"
                         class="w-full h-auto block aspect-square object-cover rounded-lg">
                @else

                <picture>
                    <source media="(min-width:1330px)"
                            srcset="{{Storage::disk('s3')->url('upload_img/animals/variants/720x720/' . $this->animal->avatar)}}">
                    <source media="(min-width:1024px)"
                            srcset="{{Storage::disk('s3')->url('upload_img/animals/variants/480x480/' . $this->animal->avatar)}}">
                    <source media="(min-width:768px)"
                            srcset="{{Storage::disk('s3')->url('upload_img/animals/variants/930x930/' . $this->animal->avatar)}}">
                    <source media="(min-width:576px)"
                            srcset="{{Storage::disk('s3')->url('upload_img/animals/variants/720x720/' . $this->animal->avatar)}}">
                    <source media="(max-width:575px)"
                            srcset="{{Storage::disk('s3')->url('upload_img/animals/variants/480x480/' . $this->animal->avatar)}}">
                    <img src="{{Storage::disk('s3')->url('upload_img/animals/originals/' . $this->animal->avatar)}}"
                         alt="Photo de {{$this->animal->name}}"
                         class="w-full h-auto block aspect-square object-cover rounded-lg">
                </picture>
                @endif
                    @php
                        dd([
                            'avatar_value' => $this->animal->avatar,
                            'url_original' => Storage::disk('s3')->url('upload_img/animals/originals/' . $this->animal->avatar),
                            'file_exists' => Storage::disk('s3')->exists('upload_img/animals/originals/' . $this->animal->avatar),
                            'all_files' => Storage::disk('s3')->files('upload_img/animals/originals'),
                        ]);
                    @endphp
            </div>
            <div class="lg:col-span-6">
                <x-cards.animal-data
                    :name="$this->animal->name"
                    :state="$this->animal->state"
                    :sexe="$this->animal->sexe"
                    :data_animals_profile="$this->animal_profil_value"
                    :data_animals_behavior="$this->animal_behavior_value"
                    :id="$this->animal->id"
                >
                </x-cards.animal-data>
            </div>
            <section class="flex flex-col bg-white border border-main-blue rounded-lg p-6 gap-4 lg:col-span-4">
                <div class="flex flex-wrap gap-2 items-center justify-between">
                    <h3 class="h3-article">
                        Notes :
                    </h3>
                    <button wire:click="add_note()" class="cta-primary w-fit">Ajouter une note</button>
                </div>

                <ul class="flex flex-col gap-2">
                    @forelse($this->animal_notes as $note)
                        <li wire:click="show_note({{$note->id}})"
                            class="font-poppins flex items-center gap-3 hover:text-orange-cta px-3 py-2 rounded-lg cursor-pointer transition-all duration-300 hover:bg-orange-50 group">
                            <span
                                class="w-1.5 h-1.5 rounded-full bg-gray-300 group-hover:bg-orange-cta transition-colors"></span>
                            {{$note->title}}
                        </li>

                    @empty
                        <p class="font-poppins">
                            Pas encore de note
                        </p>
                    @endforelse
                </ul>

            </section>
            <section class="flex flex-col bg-white border border-main-blue rounded-lg p-6 gap-4 lg:col-span-8">
                <h3 class="h3-article">
                    Descriptions
                </h3>
                <p class="font-poppins text-xl">
                    {{$this->animal->description}}
                </p>
            </section>

        </div>

    </x-admin.section>
</div>
