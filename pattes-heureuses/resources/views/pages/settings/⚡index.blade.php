<?php

use App\Models\Behavior;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {

    public $title_behavior = '';
    public $animals_behaviors = [];

    public function mount()
    {
        $this->animals_behaviors = Behavior::all();
    }

    public function save_behavior()
    {
        Behavior::create([
            'name' => $this->title_behavior,
        ]);
        $this->redirect('/settings');
    }

    public function delete_behavior(string $id): void
    {
        $this->dispatch('open_modal', ['form' => 'forms::delete_form', 'model_id' => $id]);
    }


    #[On('behaviors_list_changed')]
    public function reset_behavior_list()
    {
        unset($this->animals_behaviors);
    }
};
?>

<div>

    <section class="flex flex-col gap-4">
        <h3 class="h3-article">
            Animaux
        </h3>
        <ul class="flex gap-4 flex-wrap">
            <li x-data="{ open: false }" class="w-fit">
                <button
                    @click="open = !open"
                    x-bind:class="open ? 'bg-orange-cta rounded-b-none' : 'bg-white'"
                    class="group text-2xl w-full font-fredoka font-medium flex flex-row justify-between items-center cursor-pointer hover:bg-orange-cta duration-300 border-2 border-orange-cta px-4 py-3 rounded-lg"
                >
                <span
                    class="group-hover:text-white"
                    x-bind:class="open ? 'text-white' : ''">
                    Espèces
                </span>
                    <svg
                        class="group-hover:fill-white transition-transform duration-300"
                        x-bind:class="open ? 'rotate-360 fill-white' : 'rotate-270'"
                        xmlns="http://www.w3.org/2000/svg"
                        width="28" height="28" viewBox="-6.5 0 32 32"
                    >
                        <path
                            d="m18.813 11.406-7.906 9.906c-.75.906-1.906.906-2.625 0L.376 11.406c-.75-.938-.375-1.656.781-1.656h16.875c1.188 0 1.531.719.781 1.656z"/>
                    </svg>
                </button>

                <ul class="flex flex-col gap-8 p-4 border-2 border-orange-cta border-t-0 rounded-b-lg bg-white" x-show="open" x-collapse>
                    @foreach($this->animals_behaviors as $behavior)
                        <li class="flex font-poppins text-xl justify-between gap-6">
                    <span>
                        {{$behavior->name}}
                    </span>
                            <div class="flex flex-row gap-4">
                                <a href="#"
                                   x-data="{hover : false}"
                                   @mouseenter="hover = true"
                                   @mouseleave="hover = false"
                                   class="bg-orange-cta border-2 border-orange-cta hover:bg-white duration-300 hover:duration-300 p-1 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         viewBox="0 0 24 24">
                                        <path x-bind:fill="hover ? '#ff7b00' : 'white'"
                                              fill-rule="evenodd"
                                              d="M20.848 1.879a3 3 0 0 0-4.243 0L2.447 16.036a3 3 0 0 0-.82 1.533l-.587 2.936a2 2 0 0 0 2.353 2.353l2.936-.587a3 3 0 0 0 1.533-.82L22.019 7.293a3 3 0 0 0 0-4.243L20.848 1.88Zm-2.829 1.414a1 1 0 0 1 1.415 0l1.171 1.171a1 1 0 0 1 0 1.415L17.933 8.55l-2.585-2.586 2.671-2.671Zm-4.086 4.086L3.862 17.45a1 1 0 0 0-.274.51l-.587 2.936 2.935-.587a1 1 0 0 0 .511-.274L16.52 9.964 13.933 7.38Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </a>
                                <a href="#" wire:click="delete_behavior({{ $behavior->id }})"
                                   x-data="{hover : false}"
                                   @mouseenter="hover = true"
                                   @mouseleave="hover = false"
                                   class="bg-red-600 border-2 border-red-600 hover:bg-white duration-300 hover:duration-300 p-1 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" x-bind:fill="hover ? '#E7000B' : 'white'"
                                         viewBox="0 0 24 24">
                                        <path  fill-rule="evenodd"
                                               d="M5.293 5.293a1 1 0 0 1 1.414 0L12 10.586l5.293-5.293a1 1 0 1 1 1.414 1.414L13.414 12l5.293 5.293a1 1 0 0 1-1.414 1.414L12 13.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L10.586 12 5.293 6.707a1 1 0 0 1 0-1.414Z"
                                               clip-rule="evenodd"/>
                                    </svg>
                                </a>
                            </div>
                        </li>
                    @endforeach

                </ul>

            </li>
            <li x-data="{ open: false }" class="w-fit">
                <button
                    @click="open = !open"
                    x-bind:class="open ? 'bg-orange-cta rounded-b-none' : 'bg-white'"
                    class="group text-2xl w-full font-fredoka font-medium flex flex-row justify-between items-center cursor-pointer hover:bg-orange-cta duration-300 border-2 border-orange-cta px-4 py-3 rounded-lg"
                >
                <span
                    class="group-hover:text-white"
                    x-bind:class="open ? 'text-white' : ''">
                    Races
                </span>
                    <svg
                        class="group-hover:fill-white transition-transform duration-300"
                        x-bind:class="open ? 'rotate-360 fill-white' : 'rotate-270'"
                        xmlns="http://www.w3.org/2000/svg"
                        width="28" height="28" viewBox="-6.5 0 32 32"
                    >
                        <path
                            d="m18.813 11.406-7.906 9.906c-.75.906-1.906.906-2.625 0L.376 11.406c-.75-.938-.375-1.656.781-1.656h16.875c1.188 0 1.531.719.781 1.656z"/>
                    </svg>
                </button>

                <ul class="flex flex-col gap-8 p-4 border-2 border-orange-cta border-t-0 rounded-b-lg bg-white" x-show="open" x-collapse>
                    @foreach($this->animals_behaviors as $behavior)
                        <li class="flex font-poppins text-xl justify-between gap-6">
                    <span>
                        {{$behavior->name}}
                    </span>
                            <div class="flex flex-row gap-4">
                                <a href="#"
                                   x-data="{hover : false}"
                                   @mouseenter="hover = true"
                                   @mouseleave="hover = false"
                                   class="bg-orange-cta border-2 border-orange-cta hover:bg-white duration-300 hover:duration-300 p-1 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         viewBox="0 0 24 24">
                                        <path x-bind:fill="hover ? '#ff7b00' : 'white'"
                                              fill-rule="evenodd"
                                              d="M20.848 1.879a3 3 0 0 0-4.243 0L2.447 16.036a3 3 0 0 0-.82 1.533l-.587 2.936a2 2 0 0 0 2.353 2.353l2.936-.587a3 3 0 0 0 1.533-.82L22.019 7.293a3 3 0 0 0 0-4.243L20.848 1.88Zm-2.829 1.414a1 1 0 0 1 1.415 0l1.171 1.171a1 1 0 0 1 0 1.415L17.933 8.55l-2.585-2.586 2.671-2.671Zm-4.086 4.086L3.862 17.45a1 1 0 0 0-.274.51l-.587 2.936 2.935-.587a1 1 0 0 0 .511-.274L16.52 9.964 13.933 7.38Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </a>
                                <a href="#" wire:click="delete_behavior({{ $behavior->id }})"
                                   x-data="{hover : false}"
                                   @mouseenter="hover = true"
                                   @mouseleave="hover = false"
                                   class="bg-red-600 border-2 border-red-600 hover:bg-white duration-300 hover:duration-300 p-1 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" x-bind:fill="hover ? '#E7000B' : 'white'"
                                         viewBox="0 0 24 24">
                                        <path  fill-rule="evenodd"
                                               d="M5.293 5.293a1 1 0 0 1 1.414 0L12 10.586l5.293-5.293a1 1 0 1 1 1.414 1.414L13.414 12l5.293 5.293a1 1 0 0 1-1.414 1.414L12 13.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L10.586 12 5.293 6.707a1 1 0 0 1 0-1.414Z"
                                               clip-rule="evenodd"/>
                                    </svg>
                                </a>
                            </div>
                        </li>
                    @endforeach

                </ul>

            </li>
            <li x-data="{ open: false }" class="w-fit">
                <button
                    @click="open = !open"
                    x-bind:class="open ? 'bg-orange-cta rounded-b-none' : 'bg-white'"
                    class="group text-2xl w-full font-fredoka font-medium flex flex-row justify-between items-center cursor-pointer hover:bg-orange-cta duration-300 border-2 border-orange-cta px-4 py-3 rounded-lg"
                >
                <span
                    class="group-hover:text-white"
                    x-bind:class="open ? 'text-white' : ''">
                    Pelages
                </span>
                    <svg
                        class="group-hover:fill-white transition-transform duration-300"
                        x-bind:class="open ? 'rotate-360 fill-white' : 'rotate-270'"
                        xmlns="http://www.w3.org/2000/svg"
                        width="28" height="28" viewBox="-6.5 0 32 32"
                    >
                        <path
                            d="m18.813 11.406-7.906 9.906c-.75.906-1.906.906-2.625 0L.376 11.406c-.75-.938-.375-1.656.781-1.656h16.875c1.188 0 1.531.719.781 1.656z"/>
                    </svg>
                </button>

                <ul class="flex flex-col gap-8 p-4 border-2 border-orange-cta border-t-0 rounded-b-lg bg-white" x-show="open" x-collapse>
                    @foreach($this->animals_behaviors as $behavior)
                        <li class="flex font-poppins text-xl justify-between gap-6">
                    <span>
                        {{$behavior->name}}
                    </span>
                            <div class="flex flex-row gap-4">
                                <a href="#"
                                   x-data="{hover : false}"
                                   @mouseenter="hover = true"
                                   @mouseleave="hover = false"
                                   class="bg-orange-cta border-2 border-orange-cta hover:bg-white duration-300 hover:duration-300 p-1 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         viewBox="0 0 24 24">
                                        <path x-bind:fill="hover ? '#ff7b00' : 'white'"
                                              fill-rule="evenodd"
                                              d="M20.848 1.879a3 3 0 0 0-4.243 0L2.447 16.036a3 3 0 0 0-.82 1.533l-.587 2.936a2 2 0 0 0 2.353 2.353l2.936-.587a3 3 0 0 0 1.533-.82L22.019 7.293a3 3 0 0 0 0-4.243L20.848 1.88Zm-2.829 1.414a1 1 0 0 1 1.415 0l1.171 1.171a1 1 0 0 1 0 1.415L17.933 8.55l-2.585-2.586 2.671-2.671Zm-4.086 4.086L3.862 17.45a1 1 0 0 0-.274.51l-.587 2.936 2.935-.587a1 1 0 0 0 .511-.274L16.52 9.964 13.933 7.38Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </a>
                                <a href="#" wire:click="delete_behavior({{ $behavior->id }})"
                                   x-data="{hover : false}"
                                   @mouseenter="hover = true"
                                   @mouseleave="hover = false"
                                   class="bg-red-600 border-2 border-red-600 hover:bg-white duration-300 hover:duration-300 p-1 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" x-bind:fill="hover ? '#E7000B' : 'white'"
                                         viewBox="0 0 24 24">
                                        <path  fill-rule="evenodd"
                                               d="M5.293 5.293a1 1 0 0 1 1.414 0L12 10.586l5.293-5.293a1 1 0 1 1 1.414 1.414L13.414 12l5.293 5.293a1 1 0 0 1-1.414 1.414L12 13.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L10.586 12 5.293 6.707a1 1 0 0 1 0-1.414Z"
                                               clip-rule="evenodd"/>
                                    </svg>
                                </a>
                            </div>
                        </li>
                    @endforeach

                </ul>

            </li>
            <li x-data="{ open: false }" class="w-fit">
                <button
                    @click="open = !open"
                    x-bind:class="open ? 'bg-orange-cta rounded-b-none' : 'bg-white'"
                    class="group text-2xl w-full font-fredoka font-medium flex flex-row justify-between items-center cursor-pointer hover:bg-orange-cta duration-300 border-2 border-orange-cta px-4 py-3 rounded-lg"
                >
                <span
                    class="group-hover:text-white"
                    x-bind:class="open ? 'text-white' : ''">
                    Caractères
                </span>
                    <svg
                        class="group-hover:fill-white transition-transform duration-300"
                        x-bind:class="open ? 'rotate-360 fill-white' : 'rotate-270'"
                        xmlns="http://www.w3.org/2000/svg"
                        width="28" height="28" viewBox="-6.5 0 32 32"
                    >
                        <path
                            d="m18.813 11.406-7.906 9.906c-.75.906-1.906.906-2.625 0L.376 11.406c-.75-.938-.375-1.656.781-1.656h16.875c1.188 0 1.531.719.781 1.656z"/>
                    </svg>
                </button>

                <ul class="flex flex-col gap-8 p-4 border-2 border-orange-cta border-t-0 rounded-b-lg bg-white" x-show="open" x-collapse>
                    @foreach($this->animals_behaviors as $behavior)
                        <li class="flex font-poppins text-xl justify-between gap-6">
                    <span>
                        {{$behavior->name}}
                    </span>
                            <div class="flex flex-row gap-4">
                                <a href="#"
                                   x-data="{hover : false}"
                                   @mouseenter="hover = true"
                                   @mouseleave="hover = false"
                                   class="bg-orange-cta border-2 border-orange-cta hover:bg-white duration-300 hover:duration-300 p-1 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         viewBox="0 0 24 24">
                                        <path x-bind:fill="hover ? '#ff7b00' : 'white'"
                                              fill-rule="evenodd"
                                              d="M20.848 1.879a3 3 0 0 0-4.243 0L2.447 16.036a3 3 0 0 0-.82 1.533l-.587 2.936a2 2 0 0 0 2.353 2.353l2.936-.587a3 3 0 0 0 1.533-.82L22.019 7.293a3 3 0 0 0 0-4.243L20.848 1.88Zm-2.829 1.414a1 1 0 0 1 1.415 0l1.171 1.171a1 1 0 0 1 0 1.415L17.933 8.55l-2.585-2.586 2.671-2.671Zm-4.086 4.086L3.862 17.45a1 1 0 0 0-.274.51l-.587 2.936 2.935-.587a1 1 0 0 0 .511-.274L16.52 9.964 13.933 7.38Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </a>
                                <a href="#" wire:click="delete_behavior({{ $behavior->id }})"
                                   x-data="{hover : false}"
                                   @mouseenter="hover = true"
                                   @mouseleave="hover = false"
                                   class="bg-red-600 border-2 border-red-600 hover:bg-white duration-300 hover:duration-300 p-1 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" x-bind:fill="hover ? '#E7000B' : 'white'"
                                         viewBox="0 0 24 24">
                                        <path  fill-rule="evenodd"
                                               d="M5.293 5.293a1 1 0 0 1 1.414 0L12 10.586l5.293-5.293a1 1 0 1 1 1.414 1.414L13.414 12l5.293 5.293a1 1 0 0 1-1.414 1.414L12 13.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L10.586 12 5.293 6.707a1 1 0 0 1 0-1.414Z"
                                               clip-rule="evenodd"/>
                                    </svg>
                                </a>
                            </div>
                        </li>
                    @endforeach
                    <li x-data="{open : false}">
                        <button class="cta-primary w-full" @click="open = !open">
                            Ajouter +
                        </button>
                        <div
                            x-show="open"
                            x-transition.opacity
                            @click="open = false"
                            class="fixed inset-0 bg-black/50 z-2">
                        </div>
                        <div x-show="open" @click.outside="open = false"
                             class="fixed origin-center z-3 -translate-y-1/2 p-4 lg:p-12 -translate-x-1/2 top-1/2 w-full left-1/2 max-w-[50%] max-h-[50vh] bg-white overflow-y-scroll flex flex-col gap-12">
                            <form wire:submit="save_behavior()">
                                <fieldset>
                                    <legend>
                                        Nouveau caractère
                                    </legend>
                                    <x-forms.input wire:model="title_behavior" :name="'new-behavior'" :type="'text'" :label="'Intitulé'"/>
                                    <x-forms.submit>
                                        Créer
                                    </x-forms.submit>
                                </fieldset>
                            </form>
                        </div>
                    </li>

                </ul>


            </li>
            <li x-data="{ open: false }" class="w-fit">
                <button
                    @click="open = !open"
                    x-bind:class="open ? 'bg-orange-cta rounded-b-none' : 'bg-white'"
                    class="group text-2xl w-full font-fredoka font-medium flex flex-row justify-between items-center cursor-pointer hover:bg-orange-cta duration-300 border-2 border-orange-cta px-4 py-3 rounded-lg"
                >
                <span
                    class="group-hover:text-white"
                    x-bind:class="open ? 'text-white' : ''">
                    Caractères
                </span>
                    <svg
                        class="group-hover:fill-white transition-transform duration-300"
                        x-bind:class="open ? 'rotate-360 fill-white' : 'rotate-270'"
                        xmlns="http://www.w3.org/2000/svg"
                        width="28" height="28" viewBox="-6.5 0 32 32"
                    >
                        <path
                            d="m18.813 11.406-7.906 9.906c-.75.906-1.906.906-2.625 0L.376 11.406c-.75-.938-.375-1.656.781-1.656h16.875c1.188 0 1.531.719.781 1.656z"/>
                    </svg>
                </button>

                <ul class="flex flex-col gap-8 p-4 border-2 border-orange-cta border-t-0 rounded-b-lg bg-white" x-show="open" x-collapse>
                    @foreach($this->animals_behaviors as $behavior)
                        <li class="flex font-poppins text-xl justify-between gap-6">
                    <span>
                        {{$behavior->name}}
                    </span>
                            <div class="flex flex-row gap-4">
                                <a href="#"
                                   x-data="{hover : false}"
                                   @mouseenter="hover = true"
                                   @mouseleave="hover = false"
                                   class="bg-orange-cta border-2 border-orange-cta hover:bg-white duration-300 hover:duration-300 p-1 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                         viewBox="0 0 24 24">
                                        <path x-bind:fill="hover ? '#ff7b00' : 'white'"
                                              fill-rule="evenodd"
                                              d="M20.848 1.879a3 3 0 0 0-4.243 0L2.447 16.036a3 3 0 0 0-.82 1.533l-.587 2.936a2 2 0 0 0 2.353 2.353l2.936-.587a3 3 0 0 0 1.533-.82L22.019 7.293a3 3 0 0 0 0-4.243L20.848 1.88Zm-2.829 1.414a1 1 0 0 1 1.415 0l1.171 1.171a1 1 0 0 1 0 1.415L17.933 8.55l-2.585-2.586 2.671-2.671Zm-4.086 4.086L3.862 17.45a1 1 0 0 0-.274.51l-.587 2.936 2.935-.587a1 1 0 0 0 .511-.274L16.52 9.964 13.933 7.38Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </a>
                                <a href="#" wire:click="delete_behavior({{ $behavior->id }})"
                                   x-data="{hover : false}"
                                   @mouseenter="hover = true"
                                   @mouseleave="hover = false"
                                   class="bg-red-600 border-2 border-red-600 hover:bg-white duration-300 hover:duration-300 p-1 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" x-bind:fill="hover ? '#E7000B' : 'white'"
                                         viewBox="0 0 24 24">
                                        <path  fill-rule="evenodd"
                                               d="M5.293 5.293a1 1 0 0 1 1.414 0L12 10.586l5.293-5.293a1 1 0 1 1 1.414 1.414L13.414 12l5.293 5.293a1 1 0 0 1-1.414 1.414L12 13.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L10.586 12 5.293 6.707a1 1 0 0 1 0-1.414Z"
                                               clip-rule="evenodd"/>
                                    </svg>
                                </a>
                            </div>
                        </li>
                    @endforeach

                </ul>

            </li>
        </ul>


    </section>
</div>

