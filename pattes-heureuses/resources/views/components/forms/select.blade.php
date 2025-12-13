@props([
    'name',
    'label' => '',
    'options' => [],
    'hasLabel' => true,
    'multiple' => false,
])

<div class="flex flex-col gap-2 w-full">
    @if($hasLabel)
        <label for="{{ $name }}" class="block text-xl font-medium">
            {{ $label }}
        </label>
    @endif
    <select

        name="{{ $name }}"
        @if($multiple)
            multiple
        @endif
        id="{{ $name }}"
        class="bg-white border-2 border-orange-cta rounded-md py-3 px-4 text-xl w-full"
        {{$attributes->whereStartsWith('wire:model')}}
    >
        {{$slot}}
        @foreach($options as $key => $option)
            @php
                if (is_object($option)) {
                    if ($option instanceof BackedEnum) {
                        $optionValue = $option->value;
                        $optionLabel = $option->value;
                    }
                    else {
                        $optionValue = $option->id ?? $option->name ?? $option;
                        $optionLabel = $option->name ?? $option;
                    }
                } elseif (is_array($option)) {
                    $optionValue = $option['id'] ?? $option['name'] ?? $option;
                    $optionLabel = $option['name'] ?? $option;
                } else {
                    $optionValue = $option;
                    $optionLabel = $option;
                }
            @endphp
            <option value="{{ $optionValue }}">
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
</div>

