@props(
    [
        'name',
        'type',
        'label',
        'placeholder',
        'value' => '',
        'message',
]
)

    <label for="{{$name}}" class="{{ $type === 'search' ? 'hidden' : 'block text-sm' }}">{{$label}}</label>
    <input type="{{$type}}" id="{{$name}}" name="{{$name}}" placeholder="{!! $placeholder ?? '' !!}"
           value="{{old($name) ?? $value}}" class="border bg-white border-orange-cta rounded-md p-4 w-full">
    @if($type !== 'search')
    <span class="text-xs text-red-500 absolute left-0 -bottom-4">
        @error($name)
        {{ $message }}
        @enderror
    </span>
    @endif
