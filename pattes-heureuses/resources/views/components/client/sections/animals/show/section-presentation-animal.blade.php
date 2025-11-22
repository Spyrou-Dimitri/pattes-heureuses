@php
    $profile = [
        'type' => 'Chien',
        'breed' => 'Golden Retriever',
        'year' => '2 ans',
        'skin' => 'Doré',
    ];

    $behavior = [
        'behavior' => 'Malicieux / sympa / gentil',
        'place' => 'Tous',
        'accept_cats' => 'Oui',
        'accept_dogs' => 'Non',
        'accept_kids' => 'Non',
    ];
@endphp

<x-basics.section :bg="'paws'" :py="'landing'">
    <x-basics.grid>
        <h2 class="h2-section text-center col-span-full">
            {{__('client/animals/show/show.title')}} <strong>Jean</strong>
        </h2>
        <div class="flex w-full flex-col gap-6 lg:grid md:grid-cols-12 md:gap-12 col-span-full">
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
            </div>

            <x-basics.animal-data class="md:col-span-6"
                :name="'Jean'"
                :sexe="'male'"
                :data_animals_profile="$profile"
                :data_animals_behavior="$behavior"
            />

            <article class="flex flex-col bg-white border border-main-blue rounded-lg p-6 gap-4 md:col-span-full">
                <h3 class="h3-article">
                    Description
                </h3>
                <p class="font-poppins text-xl">
                    Benoît est un jeune husky plein d’énergie et de tendresse, arrivé au refuge après avoir vécu ses
                    premiers mois dans une famille qui ne pouvait plus s’occuper de lui. Malgré ce début de vie un peu
                    mouvementé, il a su garder son regard pétillant et son envie de découvrir le monde.

                    Véritable aventurier, Benoît adore les grandes promenades, surtout quand il peut sentir le vent dans
                    son pelage et courir à travers les champs. Mais derrière son allure de petit explorateur se cache un
                    grand sensible : il aime les câlins, les moments de calme et la présence bienveillante de ses
                    humains.

                    Sociable avec les autres chiens et très à l’aise avec les chats, Benoît cherche aujourd’hui une
                    famille active, patiente et pleine d’amour, qui saura lui offrir de longues balades et un foyer où
                    il pourra enfin poser ses valises… et ses quatre pattes heureuses.
                </p>
            </article>
        </div>
    </x-basics.grid>


</x-basics.section>
{{--
<div class="max-w-[1200px] m-auto px-8 flex flex-col gap-12 justify-center items-center">
--}}
