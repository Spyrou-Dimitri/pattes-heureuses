@props(
    [
        'img_src',
        'img_alt',
        'title',
        'breed',
        'sexe',
        'year',
        'behavior',
        'adopt_me'
]
)

<li class="flex flex-col border border-main-blue rounded-lg max-w-[400px] md:w-full ">
    <article class="">
        <img src="{{$img_src}}" alt="{{$img_alt}}" class="rounded-t-lg aspect-square">
        <div class="flex flex-col p-5 gap-3">

            <h3 class="h3-article">
                {{$title}}
            </h3>
            <p class="font-poppins">
                {{$breed}}
            </p>
            <a class="cta-primary text-center" href="#">{{$adopt_me}}</a>
        </div>

    </article>

</li>
