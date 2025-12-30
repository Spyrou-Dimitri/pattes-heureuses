<?php

use App\Models\Message;
use Livewire\Component;

new class extends Component {
    public Message $message;

    public function mount($id)
    {
        $this->message = Message::findOrFail($id);

        // Marquer comme lu automatiquement à l'ouverture
        if (!$this->message->is_read) {
            $this->message->is_read = true;
            $this->message->save();
        }
    }

    public function toggleFavourite()
    {
        $this->message->is_favourite = !$this->message->is_favourite;
        $this->message->save();
    }

    public function delete()
    {
        $this->message->delete();
        return redirect()->route('admin.messages.index')
            ->with('success', 'Message supprimé avec succès');
    }
};
?>

<div class="max-w-7xl mx-auto">
    <x-admin.section :title="'Message de ' . $this->message->first_name . ' ' . $this->message->last_name">

        <div class="bg-white border border-main-blue rounded-lg p-6 mb-6">
            <div class="flex items-start justify-between gap-4 flex-wrap">
                <section>
                    <h3 class="text-2xl font-bold font-poppins mb-4">
                        {{ $this->message->topic }}
                    </h3>
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" viewBox="-1 -1 17 21"   fill="white" stroke-width="2" stroke="#ff7B00" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.5 4.5C11.5 6.70914 9.7091 8.5 7.5 8.5C5.29086 8.5 3.5 6.70914 3.5 4.5C3.5 2.29086 5.29086 0.5 7.5 0.5C9.7091 0.5 11.5 2.29086 11.5 4.5Z" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7.5 11.5C3.63401 11.5 0.5 14.634 0.5 18.5H14.5C14.5 14.634 11.366 11.5 7.5 11.5Z"  stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="font-poppins">{{ $this->message->first_name }} {{ $this->message->last_name }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" viewBox="0 0 19 15" fill="none" stroke="#FF7B00" xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M18.5001 3.5L14.9393 5.47822C12.9541 6.5811 11.9615 7.1326 10.9103 7.3488C9.97989 7.5401 9.02029 7.5401 8.08989 7.3488C7.03873 7.1326 6.04612 6.5811 4.06089 5.47822L0.500092 3.5M3.70009 14.5H15.3001C16.4202 14.5 16.9803 14.5 17.4081 14.282C17.7844 14.0903 18.0904 13.7843 18.2821 13.408C18.5001 12.9802 18.5001 12.4201 18.5001 11.3V3.7C18.5001 2.5799 18.5001 2.01984 18.2821 1.59202C18.0904 1.21569 17.7844 0.90973 17.4081 0.71799C16.9803 0.5 16.4202 0.5 15.3001 0.5H3.70009C2.57999 0.5 2.01993 0.5 1.59211 0.71799C1.21578 0.90973 0.909821 1.21569 0.718081 1.59202C0.500091 2.01984 0.500092 2.57989 0.500092 3.7V11.3C0.500092 12.4201 0.500091 12.9802 0.718081 13.408C0.909821 13.7843 1.21578 14.0903 1.59211 14.282C2.01993 14.5 2.57998 14.5 3.70009 14.5Z"
                                        stroke="#FF7B00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <a href="mailto:{{ $this->message->email }}" class="font-poppins hover:text-orange-cta transition-colors">
                                {{ $this->message->email }}
                            </a>
                        </div>

                        @if($this->message->telephone)
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-orange-cta" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <a href="tel:{{ $this->message->telephone }}" class="font-poppins hover:text-orange-cta transition-colors">
                                    {{ $this->message->telephone }}
                                </a>
                            </div>
                        @endif

                        <div class="flex items-center gap-2 text-sm text-gray-500 pt-2">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 378.311 378.311">
                                <path fill="#6A7282" d="M189.156 0C84.858 0 .001 84.858.001 189.155c0 104.298 84.857 189.155 189.155 189.155 104.304 0 189.154-84.857 189.154-189.155C378.31 84.858 293.46 0 189.156 0zm0 347.144c-87.117 0-157.988-70.87-157.988-157.988 0-87.115 70.871-157.988 157.988-157.988s157.986 70.873 157.986 157.988c0 87.117-70.87 157.988-157.986 157.988z"/>
                                <path fill="#6A7282"
                                        d="M204.739 182.963V75.841c0-8.606-6.977-15.584-15.583-15.584-8.605 0-15.582 6.978-15.582 15.584v113.314c0 4.839 2.25 9.101 5.703 11.962.146.176.245.373.397.546l58.438 66.354a15.572 15.572 0 0 0 11.701 5.279 15.5 15.5 0 0 0 10.289-3.888c6.461-5.692 7.084-15.537 1.398-21.998l-56.761-64.447z"/>
                            </svg>
                            <span>Reçu le {{ $this->message->created_at->format('d/m/Y à H:i') }}</span>
                        </div>
                    </div>
                </section>

                <div class="flex gap-2 flex-wrap">
                    <button
                        wire:click="toggleFavourite()"
                        class="p-3 rounded-lg border-2 border-orange-cta cursor-pointer transition-all duration-300 hover:bg-orange-cta {{ $this->message->is_favourite ? 'bg-orange-cta' : 'bg-white' }}"
                        title="{{ $this->message->is_favourite ? 'Retirer des favoris' : 'Ajouter aux favoris' }}"
                    >
                        <div class="cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 -0.5 33 33">
                                <path
                                    fill="{{ $this->message->is_favourite ? '#edc110' : 'white' }}"
                                    stroke="{{ $this->message->is_favourite ? 'none' : '#edc110' }}"
                                    stroke-width="2"
                                    fill-rule="evenodd"
                                    d="m26.865 31.83-10.25-5.621-10.153 5.8 2.091-11.647-8.563-8.027 11.542-1.577L16.394 0l5.042 10.672L33 12.047l-8.426 8.173z"
                                />
                            </svg>
                        </div>

                    </button>
                    <a class="cta-primary" href="mailto:{{ $this->message->email }}" title="Contacter {{$this->message->last_name}} {{$this->message->first_name}}">Contacter</a>

                    <button
                        wire:click="delete()"
                        wire:confirm="Êtes-vous sûr de vouloir supprimer ce message ?"
                        class="delete"
                    >
                        Supprimer
                    </button>

                </div>
            </div>
        </div>

        <div class="bg-white border border-main-blue rounded-lg p-8">
            <h3 class="text-xl font-semibold font-poppins mb-4">Message :</h3>
            <div class="font-poppins text-lg leading-relaxed">
                {{ $this->message->description }}
            </div>
        </div>

    </x-admin.section>
</div>
