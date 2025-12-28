<?php

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {

    public $volunteer;
    public $datas_volunteer;
    public array $disponibilities = [];

    public array $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    public array $time_slots = ['morning' => 'Matin', 'afternoon' => 'Après-midi'];

    public function mount($id)
    {
        $this->volunteer = User::findOrFail($id);
        $this->datas_volunteer = [
            'last_name' => $this->volunteer->last_name,
            'first_name' => $this->volunteer->first_name,
            'sexe' => $this->volunteer->sexe->label(),
            'email' => $this->volunteer->email,
            'phone' => $this->volunteer->telephone,
            'role' => $this->volunteer->role->label(),
        ];
        $this->disponibilities = $this->volunteer->disponibilities;
    }

    public function change_password()
    {
        $this->dispatch('open_modal', ['form' => 'modals::volunteers.change-password', 'model_id' => $this->volunteer->id]);
    }

    public function change_disponibilities()
    {
        $this->dispatch('open_modal', ['form' => 'modals::volunteers.change-disponibilities', 'model_id' => $this->volunteer->id]);
    }

    #[On('disponibilities_updated')]
    public function refresh_disponibilities()
    {
        $this->volunteer->refresh();
        $this->disponibilities = $this->volunteer->disponibilities;
    }
};
?>

<div>
    <x-admin.section :title="'Fiche de' . ' ' . $this->volunteer->last_name . ' '. $this->volunteer->first_name"
                     :align="true">
        <div class="flex w-full flex-col gap-6 lg:items-start  lg:grid lg:grid-cols-2">
            <x-cards.volunteer-data :volunteer="$this->volunteer"
                                    :name="$this->volunteer->first_name . ' '. $this->volunteer->last_name"
                                    :data_volunteer="$this->datas_volunteer"
                                    :id="$this->volunteer->id">
            </x-cards.volunteer-data>
            <picture>
                <source media="(min-width:1330px)"
                        srcset="{{asset('upload_img/animals/variants/720x720/' . $this->volunteer->avatar)}}">
                <source media="(min-width:1024px)"
                        srcset="{{asset('upload_img/animals/variants/480x480/' . $this->volunteer->avatar)}}">
                <source media="(min-width:768px)"
                        srcset="{{asset('upload_img/animals/variants/930x930/' . $this->volunteer->avatar)}}">
                <source media="(min-width:576px)"
                        srcset="{{asset('upload_img/animals/variants/720x720/' . $this->volunteer->avatar)}}">
                <source media="(max-width:575px)"
                        srcset="{{asset('upload_img/animals/variants/480x480/' . $this->volunteer->avatar)}}">
                <img src="{{asset('upload_img/animals/originals/' . $this->volunteer->avatar)}}"
                     alt="Photo de {{$this->volunteer->name}}"
                     class="w-full h-auto block aspect-square object-cover rounded-lg">
            </picture>
            <section class="lg:col-span-full flex flex-col gap-6">
                <h3 class="h3-article">
                    Disponibilité
                </h3>
                <table class="w-full">
                    <thead class="bg-gray-100">
                    <tr class="font-poppins font-bold">
                        <th class="p-4 text-left border border-gray-300"></th>
                        @foreach($this->days as $day)
                            <th class="p-4 border border-gray-300">{{$day}}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($this->time_slots as $time_slot => $label)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 font-semibold bg-gray-50">{{ $label }}</td>
                            @foreach($this->days as $day)
                                <td class="border border-gray-300 text-center transition-colors {{ $disponibilities[$day][$time_slot] ?? false ? 'bg-green-100' : 'bg-red-50' }}">
                                    <div class="flex items-center justify-center py-4">
                            <span
                                class="font-semibold {{ $disponibilities[$day][$time_slot] ?? false ? 'text-green-700' : 'text-red-700' }}">
                                {{ $disponibilities[$day][$time_slot] ?? false ? 'Oui' : 'Non' }}
                            </span>
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @can('update', $this->volunteer)
                <button wire:click="change_disponibilities()" type="button" class="cta-primary mx-auto">Modifier les
                    disponibilités
                </button>
                @endcan
            </section>
        </div>
    </x-admin.section>

</div>
