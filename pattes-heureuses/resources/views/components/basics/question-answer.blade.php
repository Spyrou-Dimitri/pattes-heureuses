@props(
    [
        'question' => '',
        'answer' => '',
]
)

<article class="bg-orange-cta p-8 overflow-hidden relative rounded-lg duration-300">
    <h4 class="w-3/4 text-xl font-fredoka font-semibold text-white">{{ $question }}</h4>

    <input id="faq-{{ $question }}"  type="checkbox" class="button-faq hidden absolute right-8 top-6 z-5">

        <label for="faq-{{ $question }}" class="faq-wrapper cursor-pointer absolute right-8 top-6">
        <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" fill="white">
            <rect width="44" height="44" fill="#fff" rx="22"/>
            <path fill="#EB770F"
                  d="m22.224 28.553 6.197-12.395A.8.8 0 0 0 27.706 15H16.294a.8.8 0 0 0-.715 1.158l6.197 12.395a.25.25 0 0 0 .448 0Z"/>
        </svg>
    </label>

    <p class="max-h-0 scale-y-0 origin-top duration-300">
        {{ $answer }}
    </p>
</article>
