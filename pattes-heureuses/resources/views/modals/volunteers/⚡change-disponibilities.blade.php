<?php

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public User $volunteer;
    public array $disponibilities = [];
    public array $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    public array $time_slots = ['morning' => 'Matin', 'afternoon' => 'Après-midi'];


    public function mount($model_id)
    {

        $this->volunteer = User::findOrFail($model_id);
        $this->authorize('update', $this->volunteer);
        $this->disponibilities = $this->volunteer->disponibilities;
    }

    public function update_disponibilities()
    {
        $this->volunteer->disponibilities = $this->disponibilities;
        $this->volunteer->save();
        $this->dispatch('close_modal');
        $this->dispatch('disponibilities_updated');
    }

}
?>


<div wire:click="dispatch('close_modal')"
     @keydown.escape.window="$wire.dispatch('close_modal')"
     x-trap.inert.noscroll="true"
     class="fixed flex justify-center items-center w-full min-h-screen top-0 right-0 bg-black/20">
    <div wire:click.stop
         class="fixed origin-center rounded-lg z-3 -translate-y-1/2 p-4 lg:p-12 -translate-x-1/2 top-1/2 w-full left-1/2 max-w-[90%] max-h-[90vh] bg-white overflow-y-scroll flex flex-col gap-12">
        <button type="button" wire:click="dispatch('close_modal')"
                class="cursor-pointer w-fit p-2 self-end rounded-lg bg-orange-cta">
            <svg viewBox="0 0 24 24" fill="none" width="28" height=28" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_iconCarrier">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z"
                          fill="#FFFFFF"></path>
                </g>
            </svg>
        </button>

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
                            <label class="flex items-center justify-center gap-2 w-full py-4 cursor-pointer"
                                   for="disponibilities_{{ $day }}_{{ $time_slot }}">
                                <input type="checkbox"
                                       id="disponibilities_{{ $day }}_{{ $time_slot }}"
                                       wire:model.live="disponibilities.{{ $day }}.{{ $time_slot }}"
                                       class="sr-only">
                                <span
                                    class="font-semibold {{ $disponibilities[$day][$time_slot] ?? false ? 'text-green-700' : 'text-red-700' }}">
                                            {{ $disponibilities[$day][$time_slot] ?? false ? 'Oui' : 'Non' }}
                                        </span>
                            </label>
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
        <button wire:click="update_disponibilities()" type="button" class="cta-primary w-fit mx-auto">Mettre à jour</button>
    </div>

</div>
