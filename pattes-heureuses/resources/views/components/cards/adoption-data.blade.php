@php use App\Enums\SexeAnimal; @endphp
@props([
    'title' =>'',
    'state' => null,
    'first_section' => [],
    'second_section' => [],
    'motivations' => null,
    'id' => '',

    ]
)

<article {{ $attributes->merge([
    'class' => 'flex flex-col gap-5 border border-main-blue rounded-lg p-6 bg-white'
]) }}>
    <div class="flex flex-row flex-wrap gap-2 items-center justify-between border-b-2 border-b-main-blue pb-5">
        <h3 class="h3-article flex flex-row items-center gap-2">
            {{$title}}
        </h3>
        @if(str_contains(request()->getHost(), 'admin') && !is_null($state))
            <button wire:click="change_status()"
                    class="cursor-pointer text-2xl rounded-lg gap-2 border-2 font-poppins flex flex-row items-center font-semibold py-2 px-3 bg-gray-50/2 {{$state->color()}}">
                <svg width="16" height="16" viewBox="0 0 10 10" aria-hidden="true">
                    <circle cx="5" cy="5" r="5" fill="currentColor"/>
                </svg>
                {{$state->label()}}
            </button>
        @endif
    </div>
    <dl class="flex flex-col gap-5 border-b-2 border-b-main-blue pb-5 items-center">
        @foreach($first_section as $label => $value)
            <div class="flex flex-col sm:flex-row justify-between w-full">
                <x-basics.dt>
                    {{ __("client/animals/show/show.$label") }}
                </x-basics.dt>
                <x-basics.dd>
                    {{ $value }}
                </x-basics.dd>
            </div>
        @endforeach
    </dl>
    <dl class="flex flex-col gap-5 items-center">
        @foreach($second_section as $label => $value)
            <div class="flex flex-col sm:flex-row justify-between w-full">

                <x-basics.dt>
                    {{ __("client/animals/show/show.$label") }}
                </x-basics.dt>
                <x-basics.dd>
                    {{ $value }}
                </x-basics.dd>
            </div>

        @endforeach
    </dl>
    @if(!is_null($motivations))
        <dl class="flex flex-col gap-5 border-t-2 border-t-main-blue pt-5">
            <x-basics.dt>
                {{ __("client/animals/show/show.motivation") }}
            </x-basics.dt>
            <dd class="font-poppins text-xl">
                {{$motivations}}
            </dd>
        </dl>
    @endif


</article>
