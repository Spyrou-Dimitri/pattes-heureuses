<?php

use App\Enums\AdoptionStatus;
use App\Enums\AnimalStatus;
use App\Models\Adoption;
use App\Models\Animal;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;


new class extends Component {

    public string $selectedMonth = '';
    public array $months;

    public function mount()
    {
        for ($i = 0; $i < 12; $i++) {
            $this->months[] = [
                'label' => now()->subMonth($i)->translatedFormat('M Y'),
                'value' => now()->subMonth($i)->format('Y-m'),
            ];
        }

    }

    #[Computed]
    public function animals_pending()
    {
        return Animal::where('state', AnimalStatus::PENDING->value)->get();

    }

    #[Computed]
    public function animals_count()
    {
        if ($this->selectedMonth !== '') {
            $start = Carbon::createFromFormat('Y-m', $this->selectedMonth)->startOfMonth();
            $end = Carbon::createFromFormat('Y-m', $this->selectedMonth)->endOfMonth();
            return Animal::whereBetween('created_at', [$start, $end])->get();
        }
        return Animal::orderBy('name', 'asc')->get();

    }

    #[Computed]
    public function adoptions_pending()
    {
        return Adoption::where('status', AnimalStatus::PENDING->value)->get();
    }



    #[Computed]
    public function adoptions_count()
    {
        if ($this->selectedMonth !== '') {
            $start = Carbon::createFromFormat('Y-m', $this->selectedMonth)->startOfMonth();
            $end = Carbon::createFromFormat('Y-m', $this->selectedMonth)->endOfMonth();
            return Adoption::where('status', AdoptionStatus::Completed)
                ->whereBetween('created_at', [$start, $end])->get();
        }



        return Adoption::where('status', AdoptionStatus::Completed)->get();

    }


    public function exportPdf()
    {
        if ($this->selectedMonth !== '') {
            $start = Carbon::createFromFormat('Y-m', $this->selectedMonth)->startOfMonth();
            $end   = Carbon::createFromFormat('Y-m', $this->selectedMonth)->endOfMonth();

            $animals = Animal::whereBetween('created_at', [$start, $end])->get();
            $adoptions = Adoption::where('status', AdoptionStatus::Completed->value)
                ->whereBetween('created_at', [$start, $end])
                ->get();
            $current_animals = Animal::whereIn('state', [AnimalStatus::PENDING, AnimalStatus::ADOPTABLE, AnimalStatus::UNDERCARE])
                ->whereBetween('created_at', [$start, $end])->get();

           }
        else {
            $animals = Animal::all();
            $adoptions = Adoption::where('status', AdoptionStatus::Completed->value)->get();
            $current_animals = Animal::whereIn('state', [AnimalStatus::PENDING, AnimalStatus::ADOPTABLE, AnimalStatus::UNDERCARE])->get();

        }

        $pdf = Pdf::loadView('pdf.monthly-stats', [
            'animals' => $animals,
            'adoptions' => $adoptions,
            'current_animals' => $current_animals,
            'month' => $this->selectedMonth,
        ]);

        return response()->streamDownload(
            fn () => print($pdf->output()),
            'statistiques-' . ($this->selectedMonth ?: 'tous-les-mois') . '.pdf'
        );
    }

    public function access_show($id)
    {
        return redirect()->route('animals-show', $id);
    }



};
?>
<div class="flex flex-col gap-12">
    <x-admin.section :title="__('admin/dashboard/dashboard.welcome')">
        <ul class="flex flex-col gap-6 md:flex-row md:gap-12">
            <x-cards.stat-card :icons="'paws'"
                               :title="__('admin/dashboard/dashboard.title_new_animals')"
                               :number="$this->animals_count->count()">


            </x-cards.stat-card>
            <x-cards.stat-card :icons="'hearth'"
                               :title="__('admin/dashboard/dashboard.title_new_adoptions')"
                               :number="$this->adoptions_count->count()">

            </x-cards.stat-card>
            <x-cards.stat-card :icons="'paws'"
                               :title="__('admin/dashboard/dashboard.title_new_messages')"
                               :number="Animal::all()->count()">
            </x-cards.stat-card>


        </ul>
        <div>
            <label for="filter_month" class="sr-only">Mois</label>
            <select wire:model.live="selectedMonth" name="filter_month" id="filter_month">
                <option selected value="">Tous</option>
                @foreach($this->months as $month)
                    <option value="{{$month['value']}}">{{$month['label']}}</option>
                @endforeach

            </select>
            <button wire:click="exportPdf" class="btn btn-primary mt-2">
                Télécharger PDF
            </button>
        </div>

    </x-admin.section>
    <x-admin.section :title="__('admin/dashboard/dashboard.title_new_animals')">
        <x-admin.table :header="'new_animals'">
            @foreach($this->animals_pending as $animal_pending)
                <x-admin.tr wire:click="access_show({{ $animal_pending->id }})" wire:key="{{ $animal_pending->id }}">
                    <x-admin.td>
                        <picture>
                            <source media="(min-width:768px)"
                                    srcset="{{asset('upload_img/animals/variants/128x128/' . $animal_pending->avatar)}}">
                            <source media="(min-width:576px)"
                                    srcset="{{asset('upload_img/animals/variants/720x720/' . $animal_pending->avatar)}}">
                            <source media="(max-width:575px)"
                                    srcset="{{asset('upload_img/animals/variants/480x480/' . $animal_pending->avatar)}}">
                            <img class="img-table"
                                 src="{{asset('upload_img/animals/originals/' . $animal_pending->avatar)}}"
                                 alt="Photo de {{$animal_pending->name}}">
                        </picture>
                    </x-admin.td>
                    <x-admin.td>
                        {{$animal_pending->name}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$animal_pending->breed->specie->name}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$animal_pending->breed->name}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$animal_pending->age}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$animal_pending->author}}
                    </x-admin.td>

                </x-admin.tr>
            @endforeach

        </x-admin.table>
    </x-admin.section>
    <x-admin.section :title="__('admin/dashboard/dashboard.title_new_adoptions')">
        <x-admin.table :header="'new_adoptions'">
            @foreach($this->adoptions_pending as $adoption_pending)
                <x-admin.tr wire:click="access_show({{ $adoption_pending->id }})"
                            wire:key="{{ $adoption_pending->id }}">
                    <x-admin.td>
                        <picture>
                            <source media="(min-width:768px)"
                                    srcset="{{asset('upload_img/animals/variants/128x128/' . $adoption_pending->animal->avatar)}}">
                            <source media="(min-width:576px)"
                                    srcset="{{asset('upload_img/animals/variants/720x720/' . $adoption_pending->animal->avatar)}}">
                            <source media="(max-width:575px)"
                                    srcset="{{asset('upload_img/animals/variants/480x480/' . $adoption_pending->animal->avatar)}}">
                            <img class="img-table"
                                 src="{{asset('upload_img/animals/originals/' . $adoption_pending->animal->avatar)}}"
                                 alt="Photo de {{$adoption_pending->animal->name}}">
                        </picture>
                    </x-admin.td>
                    <x-admin.td>
                        {{$adoption_pending->animal->name}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$adoption_pending->first_name . ' ' . $adoption_pending->last_name}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$adoption_pending->email}}
                    </x-admin.td>
                    <x-admin.td>
                        @if(is_null($adoption_pending->telephone))
                            Non-spécifié
                        @endif
                        {{$adoption_pending->telephone}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$adoption_pending->created_at}}
                    </x-admin.td>

                </x-admin.tr>
            @endforeach

        </x-admin.table>
    </x-admin.section>


</div>
