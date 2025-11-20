<x-basics.section :bg="'paws'" :py="'landing'">
    <div class="max-w-[1200px] m-auto px-8 flex flex-col gap-12 justify-center items-center">
        <h2 class="h2-section text-center">
            {{__('client/animals/show/show.title')}} <strong>Jean</strong>
        </h2>
        <div class="flex w-full flex-col gap-6 lg:grid lg:grid-cols-2 lg:gap-12">
            <div class="flex flex-col gap-3 lg:gap-12">
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

            <article class="flex flex-col gap-5 border border-main-blue rounded-lg p-6 bg-white">
                <div class="flex flex-row items-center justify-between border-b-2 border-b-main-blue pb-5">
                    <h3 class="h3-article">
                        Jean
                    </h3>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="20px" height="20px">
                        <path fill="#000" fill-rule="evenodd"
                              d="M7 18.005c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5ZM12 0v2h4.586l-5.4 5.402A6.955 6.955 0 0 0 7 6.004a7 7 0 1 0 7 7.001 6.968 6.968 0 0 0-1.399-4.187L18 3.419V8h2V0h-8Z"/>
                    </svg>
                </div>
                <dl class="grid grid-cols-2 gap-5 border-b-2 border-b-main-blue pb-5 items-center">
                    <x-basics.dt>
                        {{__('client/animals/show/show.type')}}
                    </x-basics.dt>
                    <x-basics.dd>
                        Chien
                    </x-basics.dd>
                    <x-basics.dt>
                        {{__('client/animals/show/show.breed')}}
                    </x-basics.dt>
                    <x-basics.dd>
                        Golden retriever
                    </x-basics.dd>
                    <x-basics.dt>
                        {{__('client/animals/show/show.year')}}
                    </x-basics.dt>
                    <x-basics.dd>
                        2 ans
                    </x-basics.dd>
                    <x-basics.dt>
                        {{__('client/animals/show/show.skin')}}
                    </x-basics.dt>
                    <x-basics.dd>
                        Doré
                    </x-basics.dd>
                </dl>
                <dl class="grid grid-cols-2 gap-5 border-b-2 border-b-main-blue pb-5 items-center">
                    <x-basics.dt>
                        {{__('client/animals/show/show.behavior')}}
                    </x-basics.dt>
                    <x-basics.dd>
                        Calme / Joueur / Malicieux
                    </x-basics.dd>
                    <x-basics.dt>
                        {{__('client/animals/show/show.place')}}
                    </x-basics.dt>
                    <x-basics.dd>
                        Tous
                    </x-basics.dd>
                    <x-basics.dt>
                        {{__('client/animals/show/show.accept_cats')}}
                    </x-basics.dt>
                    <x-basics.dd>
                        Oui
                    </x-basics.dd>
                    <x-basics.dt>
                        {{__('client/animals/show/show.accept_dogs')}}

                    </x-basics.dt>
                    <x-basics.dd>
                        Oui
                    </x-basics.dd>
                    <x-basics.dt>
                        {{__('client/animals/show/show.accept_kids')}}
                    </x-basics.dt>
                    <x-basics.dd>
                        Non
                    </x-basics.dd>
                </dl>
                <div class="flex justify-around">
                    <x-basics.cta :href="'#'" :class="'primary'">
                        Rencontrer
                    </x-basics.cta>
                    <x-basics.cta :href="'#'" :class="'secondary'">
                        Partager
                    </x-basics.cta>

                </div>

            </article>

            <article class="flex flex-col bg-white border border-main-blue rounded-lg p-6 gap-9 lg:col-span-2">
                <h3 class="h3-article">
                    Description
                </h3>
                <p class="font-poppins">
                    Benoît est un jeune husky plein d’énergie et de tendresse, arrivé au refuge après avoir vécu ses premiers mois dans une famille qui ne pouvait plus s’occuper de lui. Malgré ce début de vie un peu mouvementé, il a su garder son regard pétillant et son envie de découvrir le monde.

                    Véritable aventurier, Benoît adore les grandes promenades, surtout quand il peut sentir le vent dans son pelage et courir à travers les champs. Mais derrière son allure de petit explorateur se cache un grand sensible : il aime les câlins, les moments de calme et la présence bienveillante de ses humains.

                    Sociable avec les autres chiens et très à l’aise avec les chats, Benoît cherche aujourd’hui une famille active, patiente et pleine d’amour, qui saura lui offrir de longues balades et un foyer où il pourra enfin poser ses valises… et ses quatre pattes heureuses.
                </p>
            </article>
        </div>
    </div>

</x-basics.section>
