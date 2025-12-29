<?php


use App\Models\Animal;
use App\Models\Note;
use Livewire\Component;

new class extends Component {
    public string $title = '';
    public string $content = '';

    public $notable_id;

    public function mount(string $model_id)
    {
        $this->notable_id = $model_id;
    }

    public function rules()
    {
        return [
            'title' => 'required|min:3',
            'content' => 'required|min:3',
        ];
    }


    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function create()
    {
        $validated = $this->validate();

            Note::create([
                'title' => $this->title,
                'description' => $this->content,
                'notable_id' => $this->notable_id,
                'notable_type' => Animal::class,
                'user_id' => auth()->id(),
            ]);

        $this->dispatch('close_modal');

    }
};
?>


<div wire:click="dispatch('close_modal')"
     class="fixed flex justify-center items-center w-full min-h-screen top-0 right-0 bg-black/20">
    <form class="bg-white p-16 rounded-lg" wire:click.stop wire:submit="create()">
        <fieldset class="flex flex-col justify-center gap-4">
            <legend class="contents text-center">
                <span>Créer une note</span>
            </legend>
            <x-forms.input wire:model.blur="title" :type="'text'" :label="'Titre'" :name="'title-note'"
                           :placeholder="'Titre de la note'"/>
            <x-forms.textarea wire:model.blur="content" :type="'text'" :label="'Description'" :name="'description-note'"
                              :placeholder="'Votre note ici...'"/>
            <x-forms.submit>
                Créer
            </x-forms.submit>
        </fieldset>
    </form>
</div>
