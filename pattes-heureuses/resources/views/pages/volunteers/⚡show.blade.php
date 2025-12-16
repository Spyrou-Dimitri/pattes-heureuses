<?php

use App\Models\User;
use Livewire\Component;

new class extends Component {

    public $volunteer;
    public $datas_volunteer;

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
    }
};
?>

<div>
    <x-admin.section :title="'Fiche de' . ' ' . $this->volunteer->last_name . ' '. $this->volunteer->first_name"
                     :align="true">
        <div class="flex w-full flex-col gap-6 lg:grid lg:grid-cols-2">
            <x-cards.volunteer-data
                :name="$this->volunteer->first_name . ' '. $this->volunteer->last_name"
                :data_volunteer="$this->datas_volunteer"
            :id="$this->volunteer->id">
            </x-cards.volunteer-data>
            <img src="{{asset('img/animal/jean.jpeg')}}" alt="Photo de jean"
                 class="w-full aspect-square rounded-lg shadow-main-blue-lg">
        </div>
    </x-admin.section>
</div>
