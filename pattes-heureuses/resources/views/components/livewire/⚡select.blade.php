<?php

use App\Enums\AnimalStatus;
use App\Models\Animal;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Component;

new class extends Component {


    #[Modelable]
    public array $selected = [];

    public string $name = '';
    public string $disabled = '';

    public $models;


    #[Computed]
    public function items()
    {
        return ($this->models)::all();
    }
};
?>


<div class="relative">
    <div x-data="{ open: false }" class="flex flex-col gap-2">
        <p class="text-xl font-poppins">{{$name}} <span class="text-orange-cta">*</span></p>
        <button
            type="button"
            @click="open = !open"
            class="text-xl rounded-lg border-orange-cta border-2 px-4 py-3 cursor-pointer w-full flex justify-between items-center">
                                            <span>
                                                @if(empty($this->selected))
                                                    {{$disabled}}
                                                @else
                                                    @foreach($this->items as $item)
                                                        @if(in_array($item->id, $this->selected))
                                                            {{ $item->name }} /
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </span>
            <svg
                class="w-3 h-3"
                fill="none"
                stroke="black"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div
            x-show="open"
            @click.outside="open = false"
            @keydown.escape.window="open = false"
            class="absolute top-20 z-2 mt-1 w-full  bg-white rounded-lg shadow-lg max-h-60 overflow-y-auto">
            @foreach($this->items as $item)
                <div class="flex gap-2 hover:bg-gray-200">
                    <input
                        type="checkbox"
                        wire:model.live="selected"
                        name="{{$item->name . '_' . $item->id}}"
                        value="{{$item->id}}"
                        wire:key="{{$item->id}}"
                        id="{{$item->name . '_' . $item->id}}"
                        class="peer sr-only">
                    <label for="{{$item->name . '_' . $item->id}}"
                           class="w-full font-semibold py-3 px-8 cursor-pointer peer-checked:text-white peer-checked:bg-orange-cta peer-checked:duration-300 duration-300">
                        {{$item->name}}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>



