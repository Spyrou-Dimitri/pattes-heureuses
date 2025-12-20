
<x-layouts.section :bg="'paws'" :py="'landing'">
    <x-layouts.grid>
        <h2 class="h2-section text-center col-span-full">
            {{__('client/animals/show/show.title')}} <strong>{{$animal->name}}</strong>
        </h2>
        <div class="flex w-full flex-col gap-6 lg:grid md:grid-cols-12 md:gap-12 col-span-full">
            <picture class="md:col-span-6">
                <source media="(min-width:1330px)" srcset="{{asset('upload_img/animals/variants/720x720/' . $animal->avatar)}}">
                <source media="(min-width:1024px)" srcset="{{asset('upload_img/animals/variants/480x480/' . $animal->avatar)}}">
                <source media="(min-width:768px)" srcset="{{asset('upload_img/animals/variants/930x930/' . $animal->avatar)}}">
                <source media="(min-width:576px)" srcset="{{asset('upload_img/animals/variants/720x720/' . $animal->avatar)}}">
                <source media="(max-width:575px)" srcset="{{asset('upload_img/animals/variants/480x480/' . $animal->avatar)}}">
                <img src="{{asset('upload_img/animals/originals/' . $animal->avatar)}}" alt="Photo de {{$animal->name}}"
                     class="w-full h-auto block aspect-square object-cover rounded-lg">
            </picture>

            <x-cards.animal-data class="md:col-span-6"
                :name="$animal->name"
                :sexe="$animal->sexe"
                :data_animals_profile="$profil"
                :data_animals_behavior="$behavior"
            />

            <article class="flex flex-col bg-white border border-main-blue rounded-lg p-6 gap-4 md:col-span-full">
                <h3 class="h3-article">
                    Description
                </h3>
                <p class="font-poppins text-xl">
                    {{$animal->description}}
                </p>
            </article>
        </div>
    </x-layouts.grid>


</x-layouts.section>


{{--

<div class="flex flex-col gap-3 md:gap-12 md:col-span-6">
                <ul class="flex overflow-x-scroll flex-nowrap snap-x snap-mandatory w-full scroll-smooth gap-6">
                    <li class="min-w-[100%] snap-center">
                        <img src="{{asset('img/animal/jean.jpeg')}}" alt="Photo de jean"
                             class="w-full aspect-square rounded-lg shadow-main-blue-lg">
                    </li>
                    <li class="min-w-[100%] snap-center">
                        <img src="{{asset('img/animal/Bastien.jpg')}}" alt="Photo de jean" class="w-full aspect-square
                    rounded-lg shadow-main-blue-lg">
                    </li>
                    <li class="min-w-[100%] snap-center">
                        <img src="{{asset('img/animal/Carlos.jpg')}}" alt="Photo de jean" class="w-full aspect-square
                    rounded-lg shadow-main-blue-lg">
                    </li>
                </ul>

                <div class="flex justify-center gap-2 mt-4">
                    <button class="w-3 h-3 rounded-full bg-orange-cta"></button>
                    <button class="w-3 h-3 rounded-full bg-main-blue/30"></button>
                    <button class="w-3 h-3 rounded-full bg-main-blue/30"></button>
                </div>
--}}

