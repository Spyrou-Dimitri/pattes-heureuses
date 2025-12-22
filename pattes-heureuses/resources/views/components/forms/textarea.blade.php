<label class="block text-xl font-medium font-poppins" for="{!! $name !!}">
    {{$label}}
</label>
<textarea
    {{$attributes->whereStartsWith('wire:model.blur')}}
    class="py-2.5 px-4 border-2 rounded-lg border-orange-cta w-full"
    rows="10"
    name="{!! $name !!}"
    id="{!! $name !!}"
    placeholder="{!! $placeholder !!}">
                    </textarea>
{{$slot}}
