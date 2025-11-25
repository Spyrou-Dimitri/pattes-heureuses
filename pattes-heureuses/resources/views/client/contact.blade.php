<x-layouts.auth>

    <x-layouts.section :bg="'paws'" :py="'landing'">
        @php

            $infos = [
                [
                    'label' => 'Rue du refuge 48, Verviers',
                    'title' => "Accéder à la page google map de notre refuge",
                    'href' => ''
                ],
                [
                    'label' => 'pattes.heureuses@gmail.com',
                    'title' => "L'adresse email des Pattes Heureuses",
                    "href" => ""
                ],
                [
                    'label' => '+32 (0)409 56 32 88',
                    'title' => "Le numéro de téléphone des Pattes Heureuses",
                    'href' => ''
                    ]


    ]
        @endphp
        <x-layouts.grid>
            <div class="md:col-span-5 flex flex-col gap-10">
                <h2 class="h2-section text-center">
                    Formulaire de contact
                </h2>
                <aside class="flex flex-col gap-7 p-12 text-center border border-main-blue rounded-lg bg-white">
                    <h3 class="h3-article">
                        Quelques infos !
                    </h3>
                    <ul class="flex flex-col gap-5">
                        @foreach($infos as $info)
                            <li>
                                <a class="lg:text-xl font-poppins" href="{!! $info['href'] !!}"
                                   title="{!!$info['title']!!}">{{$info['label']}}</a>
                            </li>
                        @endforeach

                    </ul>
                </aside>
            </div>

            <div class="md:col-span-7">
                <form action="" method="POST" class="flex flex-col gap-6 p-6 border border-main-blue rounded-lg bg-white">
                    <div class="flex gap-6 flex-col md:flex-row md:justify-between md:gap-4">
                        <x-forms.input :name="'last-name'"
                                       :type="'text'"
                                       :label="'Nom'"
                                       :placeholder="'Doe'"
                                       :required="true">
                        </x-forms.input>
                        <x-forms.input :name="'first-name'"
                                       :type="'text'"
                                       :label="'Prénom'"
                                       :placeholder="'John'"
                                       :required="true">
                        </x-forms.input>
                    </div>
                    <x-forms.input :name="'email'"
                                   :type="'email'"
                                   :label="'Email'"
                                   :placeholder="'john.doe@gmail.com'"
                                   :required="true">
                    </x-forms.input>
                    <x-forms.input :name="'telephone'"
                                   :type="'tel'"
                                   :label="'Téléphone'"
                                   :placeholder="'+32 (0) 78 68 67 99'">
                    </x-forms.input>
                    <div class="flex flex-col gap-4">
                        <x-forms.textarea :name="'message'"
                                          :label="'Message'"
                                          :placeholder="'Je souhaite vous parler de...'">

                        </x-forms.textarea>
                    </div>

                    <x-forms.submit>
                        Envoyer
                    </x-forms.submit>


                </form>
            </div>
        </x-layouts.grid>
    </x-layouts.section>

</x-layouts.auth>
