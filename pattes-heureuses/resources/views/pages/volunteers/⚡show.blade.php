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
        <div class="flex w-full flex-col gap-6 lg:items-start  lg:grid lg:grid-cols-2">
            <x-cards.volunteer-data
                :name="$this->volunteer->first_name . ' '. $this->volunteer->last_name"
                :data_volunteer="$this->datas_volunteer"
            :id="$this->volunteer->id">
            </x-cards.volunteer-data>
            <picture>
                <source media="(min-width:1330px)" srcset="{{asset('upload_img/animals/variants/720x720/' . $this->volunteer->avatar)}}">
                <source media="(min-width:1024px)" srcset="{{asset('upload_img/animals/variants/480x480/' . $this->volunteer->avatar)}}">
                <source media="(min-width:768px)" srcset="{{asset('upload_img/animals/variants/930x930/' . $this->volunteer->avatar)}}">
                <source media="(min-width:576px)" srcset="{{asset('upload_img/animals/variants/720x720/' . $this->volunteer->avatar)}}">
                <source media="(max-width:575px)" srcset="{{asset('upload_img/animals/variants/480x480/' . $this->volunteer->avatar)}}">
                <img src="{{asset('upload_img/animals/originals/' . $this->volunteer->avatar)}}" alt="Photo de {{$this->volunteer->name}}"
                     class="w-full h-auto block aspect-square object-cover rounded-lg">
            </picture>
        </div>
    </x-admin.section>
</div>
