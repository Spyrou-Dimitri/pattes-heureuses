<tr {{ $attributes->merge([
        'class' => 'md:hover:bg-gray-100 md:cursor-pointer duration-300
                    md:hover:duration-300 md:border-b-2 md:border-b-gray-100
                    flex flex-col gap-3 font-poppins p-6 border-1 bg-white
                    border-main-blue rounded-lg md:table-row md:border-0'
    ]) }}>
    {{ $slot }}
</tr>
