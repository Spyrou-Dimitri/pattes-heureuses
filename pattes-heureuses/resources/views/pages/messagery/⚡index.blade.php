<?php

use App\Enums\AnimalStatus;
use App\Enums\SexeAnimal;
use App\Models\Animal;
use App\Models\Behavior;
use App\Models\Breed;
use App\Models\Coat;
use App\Models\Message;
use App\Models\Specie;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {

    public string $term = '';
    public array $selectedMessages = [];
    public string $filter_by = '';


    #[Computed]
    public function messages()
    {

        $messages = Message::query();

        if ($this->term !== '') {
            $messages->orderBy('created_at', 'desc')
                ->where('last_name', 'like', '%' . $this->term . '%')
                ->orWhere('first_name', 'like', '%' . $this->term . '%')
                ->orWhere('topic', 'like', '%' . $this->term . '%');
        }



        if ($this->filter_by === 'date') {
            $messages->orderBy('created_at', 'desc');
        } elseif ($this->filter_by === 'author') {
            $messages->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');
        } elseif ($this->filter_by === 'favourite') {
            $messages->orderBy('is_favourite', 'desc')->orderBy('created_at', 'desc');
        }


        return $messages->orderBy('created_at', 'desc')->paginate(8);
    }


    public function delete()
    {
        foreach ($this->selectedMessages as $selectedMessage) {
            Message::destroy($selectedMessage);
        }
    }

    public function marksAsFavourite()
    {
        $messages = Message::whereIn('id', $this->selectedMessages)->get();
        foreach ($messages as $message) {
            $message->is_favourite = !$message->is_favourite;
            $message->save();
        }
        $this->selectedMessages = [];
    }

    public function toggleFavouriteSingle($messageId)
    {
        $message = Message::findOrFail($messageId);
        $message->is_favourite = !$message->is_favourite;
        $message->save();
    }
    public function access_message($id)
    {
        return redirect()->route('messagery-show', $id);
    }

};
?>
<div class="flex flex-col gap-12">
    <x-admin.section :title="'Messagerie'">
        <div class="flex flex-col gap-4 justify-between md:items-center md:flex-row flex-wrap">
            <x-forms.input :placeholder="'Nom / Prénom / Objet'" :name="'search-bar'" :label="'Barre de recherche'"
                           :type="'search'" wire:model="term"/>
            <div class="flex gap-4 flex-row">
                <label class="sr-only" for="filter-by">Filtrer par</label>
                <select wire:model.live="filter_by" name="filter-by"
                        class="bg-white border-2 border-orange-cta rounded-md py-3 px-4 text-xl"
                        id="filter-by">
                    <option selected value="">Trier par</option>
                    <option value="date">Date</option>
                    <option value="author">Auteur</option>
                    <option value="favourite">Favoris</option>

                </select>
                @if($this->selectedMessages)
                    <button
                        x-data="{hover: false}"
                        @mouseenter="hover = true"
                        @mouseleave="hover = false"
                        type="button" class="cta-secondary  flex flex-row gap-2" wire:click="marksAsFavourite()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 -0.5 33 33">
                            <path
                                x-bind:fill="hover ? 'white' : '#edc110'"
                                fill-rule="evenodd"
                                d="m26.865 31.83-10.25-5.621-10.153 5.8 2.091-11.647-8.563-8.027 11.542-1.577L16.394 0l5.042 10.672L33 12.047l-8.426 8.173z"/>
                        </svg>
                        <span>Favoris</span>
                    </button>
                    <button type="button"
                            wire:confirm="Êtes-vous sûr de vouloir supprimer ce message ?"
                            wire:click="delete()" class="delete">Effacer</button>
                @endif
            </div>

        </div>
        <x-admin.table :header="'messagery'">
            @foreach($this->messages as $message)
                <x-admin.tr wire:click="access_message({{ $message->id }})" wire:key="{{$message->id}}">
                    <x-admin.td>
                        <div class="flex items-center justify-between">
                            <label for="select-id" class="sr-only">Sélectionner cette ligne</label>
                            <input value="{{$message->id}} " name="select-id" id="select-id" type="checkbox"
                                   @click.stop
                                   wire:model.live="selectedMessages">
                            @if($message->is_favourite)
                                <input wire:click="toggleFavouriteSingle({{$message->id}})" type="checkbox"
                                       value="{{$message->id}}" id="{{$message->id . '-current'}}"
                                       name="{{$message->id . '-current'}}"
                                       class="sr-only">
                                <label
                                    for="{{$message->id . '-current'}}"
                                    class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         viewBox="0 -0.5 33 33">
                                        <path fill="#edc110" fill-rule="evenodd"
                                              d="m26.865 31.83-10.25-5.621-10.153 5.8 2.091-11.647-8.563-8.027 11.542-1.577L16.394 0l5.042 10.672L33 12.047l-8.426 8.173z"/>
                                    </svg>
                                </label>
                            @else
                                <input wire:click="toggleFavouriteSingle({{$message->id}})" type="checkbox"
                                       value="{{$message->id}}" id="{{$message->id . '-current'}}"
                                       name="{{$message->id . '-current'}}"
                                       class="sr-only">
                                <label
                                    for="{{$message->id . '-current'}}"
                                    class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         viewBox="0 -0.5 33 33">
                                        <path fill="none" fill-rule="evenodd" stroke-width="2" stroke="#edc110"
                                              d="m26.865 31.83-10.25-5.621-10.153 5.8 2.091-11.647-8.563-8.027 11.542-1.577L16.394 0l5.042 10.672L33 12.047l-8.426 8.173z"/>
                                    </svg>
                                </label>

                            @endif
                        </div>
                    </x-admin.td>
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
            {{ $this->messages->links() }}
        </div>
    </x-admin.section>
</div>




