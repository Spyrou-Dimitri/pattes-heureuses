@props([
    'name',
    'label' => '',
    'value' => null,
    'true_label' => 'Oui',
    'false_label' => 'Non',
    'required' => false,
])

<div class="flex flex-col gap-2">
    <span class="text-xl font-medium">{{ $label }}
        @if($required)
            <span class="text-orange-cta">
                *
            </span>
        @endif
    </span>
    <div class="flex gap-6">
        <div class="p-2 border-2 border-orange-cta rounded-lg">
            <label class="flex items-center gap-2">
                <input
                    {{$attributes->whereStartsWith('wire:model')}}

                    type="radio"
                    name="{{ $name }}"
                    value="1"
                    @checked($value === true || $value === 1 || $value === "1")
                >
                <span>{{ $true_label }}</span>
            </label>
        </div>


        <div class="p-2 border-2 border-orange-cta rounded-lg">
            <label class="flex items-center gap-2">
                <input
                    {{$attributes->whereStartsWith('wire:model')}}
                    type="radio"
                    name="{{ $name }}"
                    value="0"
                    @checked($value === false || $value === 0 || $value === "0")
                >
                <span>{{ $false_label }}</span>
            </label>
        </div>
    </div>
    {{$slot
}}


</div>
