<?php

use App\Enums\AnimalStatus;
use App\Models\Animal;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Component;

new class extends Component {


    #[Modelable]
    public array $selected = [];

    public Collection $models;
    public string $name = '';
    public string $disabled = '';


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
                                                    @foreach($this->models as $model)
                                                        @if(in_array($model->id, $this->selected))
                                                            {{ $model->name }} /
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
            @foreach($this->models as $model)
                <div class="flex gap-2 hover:bg-gray-200">
                    <input
                        type="checkbox"
                        wire:model.live="selected"
                        name="{{$model->name . '_' . $model->id}}"
                        value="{{$model->id}}"
                        wire:key="{{$model->id}}"
                        id="{{$model->name . '_' . $model->id}}"
                        class="peer sr-only">
                    <label for="{{$model->name . '_' . $model->id}}"
                           class="w-full font-semibold py-3 px-8 cursor-pointer peer-checked:text-white peer-checked:bg-orange-cta peer-checked:duration-300 duration-300">
                        {{$model->name}}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>



