@props([
    'name',
    'type',
    'label',
    'value',
])
<div class="flex flex-row">
    <input type="checkbox" value="{{$value}}" id="{{ $name }}" name="{{ $name }}"
           {{$attributes->whereStartsWith('wire:model')}}
           class="peer sr-only">

    <label
        for="{{ $name }}"
        class="block text-xl font-semibold p-3 bg-white border-2 rounded-lg cursor-pointer border-orange-cta peer-checked:text-white peer-checked:bg-orange-cta peer-checked:duration-300 duration-300">
        {{ $label }}
    </label>
</div>
