@props([
    'name',
    'type',
    'label',
    'placeholder',
    'value' => '',
    'message' => '',
    'required' => false,
    'multiple' => false,
])

<div {{ $attributes->merge(['class' => 'flex flex-col gap-2']) }}>
    <label
        for="{{ $name }}"
        class="{{ $type === 'search' ? 'hidden' : 'block text-xl font-medium' }}">
        {{ $label }}
        @if($required)
            *
        @endif
    </label>

    <input
        {{$attributes->whereStartsWith('wire:model')}}
        @if($multiple) multiple @endif
    type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder ?? '' }}"
        @if($required)
            required
        @endif
        value="{{ old($name) ?? $value }}"
        {{ $attributes->merge(['class' => 'bg-white border-2 border-orange-cta rounded-md py-3 px-4 text-xl w-full']) }}
        @if($type === 'search')
            wire:model.live.debounce="term"
        @endif
    >

    {{--
    @if($type !== 'search')
        <span class="text-xs text-red-500 absolute left-0 -bottom-4">
            @error($name)
            {{ $message }}
            @enderror
        </span>
    @endif
    --}}
</div>
