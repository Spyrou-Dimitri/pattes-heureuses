@props(
    [
        'img_src',
        'img_alt',
        'title',
        'role'
]
)


<li class="bg-white flex flex-col w-full justify-center items-center shadow-main-blue-lg gap-4 rounded-lg border-1 border-main-blue max-w-[300px] md:w-full">
    <article class="relative">
        <div>
            <img src="{{$img_src}}" alt="{{$img_alt}}" class="rounded-lg">
        </div>
        <div class="absolute w-4/5 rounded-lg p-3 bg-white -bottom-8 right-1/2 transform translate-x-1/2 origin-center">
            <h3 class="text-xl font-poppins text-center">
                {{$title}}
            </h3>
            <p class="font-poppins font-bold text-gray-400 text-center">
                {{$role}}
            </p>
        </div>
    </article>

</li>
