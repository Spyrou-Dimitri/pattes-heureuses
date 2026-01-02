@props(
    [
        'img_src',
        'img_alt',
        'title',
        'role',
]
)


<li class="bg-white flex flex-col w-full justify-center items-center shadow-main-blue-lg gap-4 rounded-lg border-1 border-main-blue max-w-[400px] md:w-full md:col-span-4">
    <article class="relative">
        @if(str_starts_with($img_src, 'public/img/personnel/'))
            <img src="{{asset(str_replace('public/', '', $img_src))}}"
                 alt="{{$img_src}}"
                 class="rounded-lg">
        @else
            <picture>
                <source media="(min-width:768px)"
                        srcset="{{Storage::disk('s3')->url('upload_img/animals/variants/128x128/' . $img_src)}}">
                <source media="(min-width:576px)"
                        srcset="{{Storage::disk('s3')->url('upload_img/animals/variants/720x720/' . $img_src)}}">
                <source media="(max-width:575px)"
                        srcset="{{Storage::disk('s3')->url('upload_img/animals/variants/480x480/' . $img_src)}}">
                <img class="rounded-lg"
                     src="{{Storage::disk('s3')->url('upload_img/animals/originals/' . $img_src)}}"
                     alt="{{$img_alt}}">
            </picture>
        @endif
        <div class="absolute w-4/5 rounded-lg p-3 bg-white bottom-4 right-1/2 transform translate-x-1/2 origin-center">
            <h3 class="text-xl font-poppins text-center">
                {{$title}}
            </h3>
            <p class="font-poppins font-bold text-gray-400 text-center">
                {{$role}}
            </p>
        </div>
    </article>

</li>
