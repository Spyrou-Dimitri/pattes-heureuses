@php use App\Enums\SexeAnimal; @endphp
@props(
    [
        'img_src',
        'name',
        'breed',
        'sexe',
        'age',
        'animal',
        'behaviors' => [],
]
)

<li class="bg-white flex flex-col shadow-main-blue-lg rounded-lg max-w-[400px] md:w-full md:col-span-4">
    <article class="flex flex-col">
        <div>
            <picture>
                <source media="(min-width:768px)" srcset="{{asset('upload_img/animals/variants/480x480/' . $img_src)}}">
                <source media="(min-width:576px)" srcset="{{asset('upload_img/animals/variants/720x720/' . $img_src)}}">
                <source media="(max-width:575px)" srcset="{{asset('upload_img/animals/variants/480x480/' . $img_src)}}">
                <img src="{{asset('upload_img/animals/originals/' . $img_src)}}" alt="Photo de {{$name}}"
                     class="w-full h-auto block aspect-square object-cover rounded-lg">
            </picture>
        </div>
        <div class="flex flex-col p-5 gap-4">
            <div class="flex flex-col gap-2">
                <div class="flex flex-row items-center justify-between">
                    <h3 class="h3-article">
                        {{$name}}
                    </h3>
                    @if($sexe === SexeAnimal::Male)
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="20px" height="20px">
                            <path fill="#000" fill-rule="evenodd"
                                  d="M7 18.005c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5ZM12 0v2h4.586l-5.4 5.402A6.955 6.955 0 0 0 7 6.004a7 7 0 1 0 7 7.001 6.968 6.968 0 0 0-1.399-4.187L18 3.419V8h2V0h-8Z"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="-3 0 20 20" width="20px" height="20px">
                            <path fill="#000" fill-rule="evenodd"
                                  d="M7.01 11.97a4.968 4.968 0 0 1-3.532-1.46C.333 7.37 2.59 1.995 7.01 1.995c4.417 0 6.68 5.371 3.533 8.515a4.968 4.968 0 0 1-3.533 1.46m4.931-.05C16.361 7.508 13.177 0 7.007 0 .851 0-2.37 7.507 2.051 11.92c1.11 1.11 2.933 1.76 3.932 1.966v2.124H2.986v1.995h2.997V20h1.998v-1.995h2.997V16.01H7.981v-2.124c1.998-.207 2.85-.857 3.96-1.965"/>
                        </svg>
                    @endif


                </div>
                <div class="flex flex-row items-center justify-between">
                    <p class=" font-poppins">
                        {{$breed}}
                    </p>
                    <p class="font-poppins">
                        {{$age}}
                    </p>
                </div>
            </div>


            <ul class="behaviors flex flex-row gap-2     flex-wrap justify-between">
                @foreach($behaviors as $behavior)
                    <li class="font-poppins border p-1 border-main-blue bg-gray-50 rounded-lg">{{ $behavior->name}}</li>
                @endforeach
            </ul>

            <a class="cta-primary text-center" href="{{route('animals.show', $animal)}}">Adoptez-moi</a>

        </div>


    </article>

</li>
