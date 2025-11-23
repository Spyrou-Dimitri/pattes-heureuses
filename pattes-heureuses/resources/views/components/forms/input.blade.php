@props(
    [
        'name',
        'type',
        'label',
        'placeholder',
        'value' => '',
        'message' => '',
        'required' => false
]
)
<div class="flex flex-col gap-3">
    <label for="{{$name}}" class="{{ $type === 'search' ? 'hidden' : 'block text-xl' }}">{{$label}}</label>
    <input type="{{$type}}" id="{{$name}}" name="{{$name}}" placeholder="{!! $placeholder ?? '' !!}" @if($required)
        required
           @endif
           value="{{old($name) ?? $value}}"
           class="border bg-white border-orange-cta rounded-md py-2.5 px-4 text-xl w-full">
    @if($type !== 'search')
        <span class="text-xs text-red-500 absolute left-0 -bottom-4">
        @error($name)
            {{ $message }}
            @enderror
    </span>
    @endif

</div>

