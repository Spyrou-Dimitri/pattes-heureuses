@props([
    'name',
    'data_volunteer' => [],
    'id' => '',
    ]
)


<article {{ $attributes->merge([
    'class' => 'flex flex-col gap-5 border border-main-blue rounded-lg p-6 bg-white'
]) }}>
    <div class="flex flex-row items-center justify-between border-b-2 border-b-main-blue pb-5">
        <h3 class="h3-article">
            {{$name}}
        </h3>
    </div>
    <dl class="flex flex-col gap-5 border-b-2 border-b-main-blue pb-5 items-center">
        @foreach($data_volunteer as $label => $value)
            <div class="flex flex-col sm:flex-row justify-between w-full">
                <x-basics.dt>
                    {{ __("admin/volunteers.$label")}}
                </x-basics.dt>
                <x-basics.dd>
                    {{ $value }}
                </x-basics.dd>
            </div>

        @endforeach
    </dl>
    @if(auth()->user()->id === $id)
        <div class="flex justify-around">
            <x-basics.cta :href="route('volunteers-edit', $id)" :class="'primary'">
                Modifier
            </x-basics.cta>
        </div>
    @endif


</article>
