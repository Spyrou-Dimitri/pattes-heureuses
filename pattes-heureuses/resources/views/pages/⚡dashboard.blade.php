<?php

use App\Enums\AdoptionStatus;
use App\Enums\AnimalStatus;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Message;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;


new class extends Component {
    use WithPagination;

    public string $selectedMonth = '';
    public array $months;
    public string $term_animals_pending = '';
    public string $term_adoptions_pending = '';
    public string $term_messages_not_seen = '';

    public function mount()
    {
        $this->months = [];
        for ($i = 0; $i < 12; $i++) {
            $date = now()->startOfMonth()->subMonths($i);
            $this->months[] = [
                'label' => $date->translatedFormat('M Y'),
                'value' => $date->format('Y-m'),
            ];
        }
    }

    #[Computed]
    public function animals_pending()
    {
        $query = Animal::with(['breed.specie'])
            ->where('state', AnimalStatus::PENDING->value);

        if ($this->term_animals_pending !== '') {
            $query->where('name', 'like', '%' . $this->term_animals_pending . '%');
        }

        return $query->orderByDesc('created_at')
            ->paginate(8, ['*'], 'animalPage');
    }

    #[Computed]
    public function messages_not_seen()
    {
        $query = Message::where('is_read', false);
        if ($this->term_messages_not_seen !== '') {
            $query->where('topic', 'like', '%' . $this->term_messages_not_seen . '%')
                ->orWhere('last_name', 'like', '%' . $this->term_messages_not_seen . '%')
                ->orWhere('first_name', 'like', '%' . $this->term_messages_not_seen . '%');
        }
        return $query->orderByDesc('created_at')->paginate(8, ['*'], 'messagePage');
    }

    public function access_message($id)
    {
        return redirect()->route('messagery-show', $id);
    }

    #[Computed]
    public function animals_count()
    {
        if ($this->selectedMonth !== '') {
            $start = Carbon::createFromFormat('Y-m', $this->selectedMonth)->startOfMonth();
            $end = Carbon::createFromFormat('Y-m', $this->selectedMonth)->endOfMonth();
            return Animal::whereBetween('created_at', [$start, $end])->count();
        }
        return Animal::count();

    }


    #[Computed]
    public function adoptions_pending()
    {
        $query = Adoption::with('animal')->where('status', AdoptionStatus::Pending->value);
        if ($this->term_adoptions_pending !== '') {
            $query->where('first_name', 'like', '%' . $this->term_adoptions_pending . '%')
                ->orWhere('last_name', 'like', '%' . $this->term_adoptions_pending . '%')
                ->orWhereHas('animal', function ($compacted_condition) {
                    $compacted_condition->where('name', 'like', '%' . $this->term_adoptions_pending . '%');
                });
        }
        return $query->orderByDesc('created_at')->paginate(8, ['*'], 'adoptionPage');
    }


    #[Computed]
    public function adoptions_count()
    {
        if ($this->selectedMonth !== '') {
            $start = Carbon::createFromFormat('Y-m', $this->selectedMonth)->startOfMonth();
            $end = Carbon::createFromFormat('Y-m', $this->selectedMonth)->endOfMonth();
            return Adoption::where('status', AdoptionStatus::Completed)
                ->whereBetween('created_at', [$start, $end])->count();
        }


        return Adoption::where('status', AdoptionStatus::Completed)->count();

    }

    private function getDateRange(): ?array
    {
        if ($this->selectedMonth === '') {
            return null;
        }

        $start = Carbon::createFromFormat('Y-m', $this->selectedMonth)->startOfMonth();
        $end = Carbon::createFromFormat('Y-m', $this->selectedMonth)->endOfMonth();

        return [$start, $end];
    }
    #[Computed]
    public function current_animals_count()
    {
        $query = Animal::whereIn('state', [
            AnimalStatus::PENDING,
            AnimalStatus::ADOPTABLE,
            AnimalStatus::UNDERCARE
        ]);

        if ($dateRange = $this->getDateRange()) {
            $query->whereBetween('created_at', $dateRange);
        }

        return $query->count();
    }


    public function exportPdf()
    {
        $dateRange = $this->getDateRange();

        $animalsQuery = Animal::query();
        $adoptionsQuery = Adoption::where('status', AdoptionStatus::Completed->value);
        $currentAnimalsQuery = Animal::whereIn('state', [
            AnimalStatus::PENDING,
            AnimalStatus::ADOPTABLE,
            AnimalStatus::UNDERCARE
        ]);

        if ($dateRange) {
            $animalsQuery->whereBetween('created_at', $dateRange);
            $adoptionsQuery->whereBetween('created_at', $dateRange);
            $currentAnimalsQuery->whereBetween('created_at', $dateRange);
        }

        $pdf = Pdf::loadView('pdf.monthly-stats', [
            'animals' => $animalsQuery->count(),
            'adoptions' => $adoptionsQuery->count(),
            'current_animals' => $currentAnimalsQuery->count(),
            'month' => $this->selectedMonth,
        ]);

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'statistiques-' . ($this->selectedMonth ?: 'tous-les-mois') . '.pdf'
        );
    }

    public function access_animal_show($id)
    {
        return redirect()->route('animals-show', $id);
    }

    public function access_adoption_show($id)
    {
        return redirect()->route('adoptions-show', $id);
    }


};
?>
<div class="flex flex-col gap-12">
    <x-admin.section :title="__('admin/dashboard/dashboard.welcome')">
        <ul class="flex flex-col gap-6 md:flex-row md:gap-12">
            <x-cards.stat-card :icons="'paws'"
                               :title="__('admin/dashboard/dashboard.title_new_animals')"
                               :number="$this->animals_count">


            </x-cards.stat-card>
            <x-cards.stat-card :icons="'hearth'"
                               :title="__('admin/dashboard/dashboard.title_new_adoptions')"
                               :number="$this->adoptions_count">

            </x-cards.stat-card>
            <x-cards.stat-card :icons="'paws'"
                               :title="__('admin/dashboard/dashboard.title_new_messages')"
                               :number="$this->current_animals_count">
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
    <x-admin.section :title="'Nouveaux animaux'" :search_bar="true" :term="'term_animals_pending'">
        <x-admin.table :header="'new_animals'">
            @foreach($this->animals_pending as $animal_pending)
                <x-admin.tr wire:click="access_animal_show({{ $animal_pending->id }})"
                            wire:key="{{ $animal_pending->id }}">
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
        <div class="mt-4">
            {{ $this->animals_pending->links() }}
        </div>
    </x-admin.section>
    <x-admin.section :title="'Nouvelles adoptions'" :search_bar="true" :term="'term_adoptions_pending'">
        <x-admin.table :header="'new_adoptions'">
            @foreach($this->adoptions_pending as $adoption_pending)
                <x-admin.tr wire:click="access_adoption_show({{ $adoption_pending->id }})"
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
        <div class="mt-4">
            {{ $this->adoptions_pending->links() }}
        </div>
    </x-admin.section>
    <x-admin.section :title="'Nouveaux messages'" :search_bar="true" :term="'term_messages_not_seen'">
        <x-admin.table :header="'messagery_dashboard'">
            @foreach($this->messages_not_seen as $message)
                <x-admin.tr wire:click="access_message({{ $message->id }})" wire:key="{{$message->id}}">
                    <x-admin.td>
                        {{$message->last_name . ' ' .$message->first_name}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$message->topic}}
                    </x-admin.td>
                    <x-admin.td>
                        {{$message->formatedForMessagery()}}
                    </x-admin.td>

                </x-admin.tr>
            @endforeach

        </x-admin.table>
        <div class="mt-4">
            {{ $this->messages_not_seen->links() }}
        </div>
    </x-admin.section>


</div>
