@props([
    'name',
    'label' => '',
    'options' => [],
    'value' => null
])

<div class="flex flex-col gap-2 w-full">
    <label for="{{ $name }}" class="block text-xl font-medium">
        {{ $label }}
    </label>

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        class="bg-white border-1 border-orange-cta rounded-md py-3 px-4 text-xl w-full">
        @foreach($options as $option)
            <option
                value="{{ $option->id }}"
                @selected($value == $option->id)
            >
                {{ $option->name }}
            </option>
        @endforeach
    </select>
</div>

