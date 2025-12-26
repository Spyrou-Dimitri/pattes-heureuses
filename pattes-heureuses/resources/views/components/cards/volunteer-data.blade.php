@props([
    'name',
    'data_volunteer' => [],
    'id' => '',
    'volunteer',
    ]
)


<article {{ $attributes->merge(['class' => 'flex flex-col gap-5 border border-main-blue rounded-lg p-6 bg-white'
]) }}>
    <div class="flex flex-row items-center justify-between border-b-2 border-b-main-blue pb-5">
        <h3 class="h3-article">
            {{$name}}
        </h3>
    </div>
    <dl class="flex flex-col gap-5 items-center">
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
    @can('update', $volunteer)
        <div class="flex justify-around  border-t-2 border-t-main-blue pt-5">
            <x-basics.cta :href="route('volunteers-edit', $id)" :class="'primary'">
                Modifier
            </x-basics.cta>
            <button type="button" class="cta-secondary cursor-pointer" wire:click="change_password()">Changer mot de passe</button>
        </div>
    @endcan


</article>
