<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

</head>
<body>
<header class="bg-white border-b-1 border-b-main-blue">
    <x-client.nav>

    </x-client.nav>
</header>

<main>
    {{$slot}}
</main>
<footer class="bg-main-blue  text-white text-xl py-13">
    <div class="flex justify-between flex-row flex-wrap gap-y-4 gap-x-16 mx-auto max-w-[1200px] p-8 text-center sm:text-left">
        <x-client.nav-secondary/>
        <section class="w-full sm:w-fit text-center sm:text-left flex flex-col gap-4">
            <h2 class="text-2xl font-fredoka font-semibold">
                Informations
            </h2>
            <ul class="font-poppins flex flex-col gap-2">
                <li>
                    <a class="nav-secondary-link" href="tel:+32 0483 39 27 84" target="_blank">+32 0483 39 27 84</a>
                </li>

                <li>
                    <a class="nav-secondary-link" href="mailto:pattes-heureuses@gmail.com" target="_blank">pattes-heureuses@gmail.com</a>
                </li>
                <li>
                    <a class="nav-secondary-link" target="_blank" href="https://www.google.com/maps/place/51%C2%B050'55.1%22N+0%C2%B033'16.6%22W/@51.848637,-0.5571949,17z/data=!3m1!4b1!4m4!3m3!8m2!3d51.848637!4d-0.55462?entry=ttu&g_ep=EgoyMDI1MTIwNy4wIKXMDSoASAFQAw%3D%3D">Rue du Refuge 48, Verviers 4800</a>
                </li>
            </ul>
        </section>
        <section class="w-full sm:w-fit text-center sm:text-left flex flex-col gap-4">
            <h2 class="text-2xl font-fredoka font-semibold">
                Horaires
            </h2>
            <ul class="font-poppins flex flex-col gap-2">
                <li>
                    Lun: 10h-18h
                </li>
                <li>
                    Mar: 10h-18h
                </li>
                <li>
                    Mer: 9h-15h
                </li>
                <li>
                    Jeu: 10h-18h
                </li>
                <li>
                    Ven: 10h-18h
                </li>
                <li>
                    Sam: 13h-18h
                </li>
                <li>
                    Dim: Fermé
                </li>
            </ul>
        </section>
    </div>


</footer>
</body>
</html>
