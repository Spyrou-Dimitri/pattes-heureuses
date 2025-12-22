@php use App\Enums\SexeAnimal; @endphp
@props([
    'name',
    'sexe',
    'state' => null,
    'data_animals_profile' => [],
    'data_animals_behavior' => [],
    'id' => '',

    ]
)


<article {{ $attributes->merge([
    'class' => 'flex flex-col gap-5 border border-main-blue rounded-lg p-6 bg-white'
]) }}>
    <div class="flex flex-row flex-wrap gap-2 items-center justify-between border-b-2 border-b-main-blue pb-5">
        <h3 class="h3-article flex flex-row items-center gap-2">
            {{$name}}
            @if($sexe === SexeAnimal::Male)
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20">
                    <path fill="#000" fill-rule="evenodd"
                          d="M7 18.005c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5ZM12 0v2h4.586l-5.4 5.402A6.955 6.955 0 0 0 7 6.004a7 7 0 1 0 7 7.001 6.968 6.968 0 0 0-1.399-4.187L18 3.419V8h2V0h-8Z"/>
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-3 0 20 20" width="24" height="24">
                    <path fill="#000" fill-rule="evenodd"
                          d="M7.01 11.97a4.968 4.968 0 0 1-3.532-1.46C.333 7.37 2.59 1.995 7.01 1.995c4.417 0 6.68 5.371 3.533 8.515a4.968 4.968 0 0 1-3.533 1.46m4.931-.05C16.361 7.508 13.177 0 7.007 0 .851 0-2.37 7.507 2.051 11.92c1.11 1.11 2.933 1.76 3.932 1.966v2.124H2.986v1.995h2.997V20h1.998v-1.995h2.997V16.01H7.981v-2.124c1.998-.207 2.85-.857 3.96-1.965"/>
                </svg>
            @endif
        </h3>
        @if(str_contains(request()->getHost(), 'admin'))
        <button wire:click="change_status()" class="cursor-pointer text-2xl rounded-lg gap-2 border-2 font-poppins flex flex-row items-center font-semibold py-2 px-3 bg-gray-50/2 {{$state->color()}}">
            <svg width="16" height="16" viewBox="0 0 10 10" aria-hidden="true">
                <circle cx="5" cy="5" r="5" fill="currentColor"/>
            </svg>
            {{$state->label()}}
        </button>
        @endif

    </div>
    <dl class="flex flex-col gap-5 border-b-2 border-b-main-blue pb-5 items-center">
        @foreach($data_animals_profile as $label => $value)
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
    <dl class="flex flex-col gap-5

    items-center">

        @foreach($data_animals_behavior as $label => $value)
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

    @if(str_contains(request()->getHost(), 'admin') && str_contains(request()->path(), 'animal'))
        <div class="flex justify-around">
            <x-basics.cta :href="route('animals-edit', $id)" :class="'primary'">
                Modifier
            </x-basics.cta>

        </div>
    @elseif(!request()->is('adoption*') && !str_contains(request()->getHost(), 'admin'))
        <div class="flex justify-around">
            <x-basics.cta :href="route('adoption.create', $id)" :class="'primary'">
                Rencontrer
            </x-basics.cta>
            <x-basics.cta :href="'#'" :class="'secondary'">
                Partager
            </x-basics.cta>
        </div>
    @endif


</article>
