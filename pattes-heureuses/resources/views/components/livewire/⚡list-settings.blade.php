<?php

use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {

    public string $title = '';
    public string $modelClass = '';


    #[Computed]
    public function items()
    {
        return ($this->modelClass)::all();
    }

    #[On('list_changed')]
    public function reset_list()
    {
        unset($this->items);
    }

    private function getComponentName($action): string {
        $modelName = strtolower(class_basename($this->modelClass));
        return "modals::settings.{$modelName}.{$action}";
    }

    public function create()
    {
        $this->dispatch('open_modal', ['form' => $this->getComponentName('create')]);
    }

    public function delete(string $id): void
    {
        $this->dispatch('open_modal', ['form' => $this->getComponentName('delete'), 'model_id' => $id]);
    }

    public function edit(string $id): void
    {
        $this->dispatch('open_modal', ['form' => $this->getComponentName('edit'), 'model_id' => $id]);
    }


};
?>

<div>
    <li x-data="{ open: false }" class="w-fit">
        <button
            @click="open = !open"
            x-bind:class="open ? 'bg-orange-cta rounded-b-none' : 'bg-white'"
            class="group text-2xl w-full font-fredoka font-medium flex flex-row justify-between items-center cursor-pointer hover:bg-orange-cta duration-300 border-2 border-orange-cta px-4 py-3 rounded-lg"
        >
                <span
                    class="group-hover:text-white"
                    x-bind:class="open ? 'text-white' : ''">
                    {{$this->title}}
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
        <ul class="flex flex-col gap-8 p-4 border-2 border-orange-cta border-t-0 rounded-b-lg bg-white"
            x-show="open"
            x-cloak
            x-collapse>
            @foreach($this->items as $item)
                <li wire:key="{{$item->id}}" class="flex font-poppins text-xl justify-between gap-6">
                    <span>
                        {{$item->name}}
                    </span>
                    <div class="flex flex-row gap-4">
                        <a href="#"
                           wire:click="edit({{$item->id}})"
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
                        <a href="#"
                           wire:click="delete({{$item->id}})"
                           x-data="{hover : false}"
                           @mouseenter="hover = true"
                           @mouseleave="hover = false"
                           class="bg-red-600 border-2 border-red-600 hover:bg-white duration-300 hover:duration-300 p-1 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                 x-bind:fill="hover ? '#E7000B' : 'white'"
                                 viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                      d="M5.293 5.293a1 1 0 0 1 1.414 0L12 10.586l5.293-5.293a1 1 0 1 1 1.414 1.414L13.414 12l5.293 5.293a1 1 0 0 1-1.414 1.414L12 13.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L10.586 12 5.293 6.707a1 1 0 0 1 0-1.414Z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </li>
            @endforeach
            <li x-data="{open : false}">
                <a class="cta-primary w-full" wire:click="create()">
                    Ajouter +
                </a>
            </li>
        </ul>
</div>
