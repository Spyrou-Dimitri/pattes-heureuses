<?php


use App\Models\Animal;
use App\Models\Note;
use Livewire\Component;

new class extends Component {
    public Note $note;

    public function mount(string $model_id)
    {
        $this->note = Note::findOrFail($model_id);
    }
};
?>


<div wire:click="dispatch('close_modal')"
     @keydown.escape.window="$wire.dispatch('close_modal')"
     x-trap.inert.noscroll="true"
     class="fixed flex justify-center items-center w-full min-h-screen top-0 right-0 bg-black/20">
    <div class="bg-white p-8 rounded-lg shadow-xl max-w-2xl w-full" wire:click.stop>

        <div class="flex items-center justify-between mb-6 pb-4 border-b-2 border-main-blue">
            <h3 class="text-2xl font-bold">
                {{ $note->title }}
            </h3>
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
        </div>

        <div class="space-y-4">
            <div>
                <p class="">
                    {{ $note->description }}
                </p>
            </div>

            <div class="pt-4 border-t-2 border-main-blue">
                <div class="flex flex-col gap-2 text-sm text-gray-500">
                    <div class="flex items-center gap-2">
                        <span>Crée par {{ $note->user->first_name ?? 'Utilisateur' }}</span>
                    </div>
                    <div class="flex items-center gap-2">

                        <span>{{ $note->created_at->format('d/m/Y à H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-6 pt-4 border-t-2 border-main-blue">
            <button
                wire:click="dispatch('close_modal')"
                class="cta-primary"
            >
                Fermer
            </button>
        </div>

    </div>
</div>
