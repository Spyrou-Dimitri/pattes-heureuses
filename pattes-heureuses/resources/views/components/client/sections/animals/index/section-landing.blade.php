@props(
    [
        'title',
        'paragraph',
        'img_src',
        'img_alt',
        'filter' => false,
        'filter_href'=> null,
        'filter_href_title' => null,
        'search' => false,
        'cta' => false,
        'cta_href' => null,
        'cta_href_title' => null
]
)

<x-layouts.section :py="'landing'" :bg="'paws'">
    <x-layouts.grid class="md:items-center">
        <div class="flex flex-col gap-4 items-start md:gap-6 md:col-span-6">
            <h2 class="h2-landing">
                {!! $title !!}
            </h2>
            <p class="font-poppins">
                {{$paragraph}}
            </p>
            <x-forms.input :type="'search'"
                            :name="'search-bar'"
                            :label="__('client/animals/index/landing.search-bar-label')"
                            :placeholder="__('client/animals/index/landing.search-bar-placerholder')">

            </x-forms.input>
            <x-basics.cta :href="$filter_href"
                          :title="$filter_href_title">
                {{$filter}}
            </x-basics.cta>


        </div>
        <div class="hidden md:block md:col-span-6">
            <img src="{{$img_src}}" alt="{{$img_alt}}"
                 class="w-full h-auto block aspect-auto object-cover rounded-lg">
        </div>
    </x-layouts.grid>
</x-layouts.section>


