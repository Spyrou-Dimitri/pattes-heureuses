@component('mail::message')
    # 🎉 Félicitations {{ $adoption->first_name }} !

    Nous avons le plaisir de vous annoncer que votre demande d'adoption pour **{{ $adoption->animal->name }}** a été **acceptée** !

    ## 🐾 Informations sur votre futur compagnon

    **Nom** : {{ $adoption->animal->name }}

    **Espèce** : {{ $adoption->animal->breed->specie->name }}

    **Race** : {{ $adoption->animal->breed->name }}

    **Âge** : {{ $adoption->animal->age }} an(s)

    **Sexe** : {{ ucfirst($adoption->animal->sexe->label()) }}

    ---

    ## 📅 Prochaines étapes

    Pour finaliser l'adoption et organiser la rencontre avec {{ $adoption->animal->name }}, nous avons besoin de connaître vos disponibilités.

    **Vous avez deux options :**

    ### Option 1 : Nous contacter par téléphone

    Appelez-nous directement pour convenir d'un rendez-vous :

    **📞 Téléphone** : [0484 49 20 49]

    **Horaires d'ouverture** :
    - Lundi, Mardi, Jeudi, vendredi : 10h00 - 18h00
    - Mercredi : 9h00 15h00
    - Samedi : 13h00 - 18h00

    ### Option 2 : Envoyer vos créneaux par message

    Utilisez notre formulaire de contact pour nous communiquer vos disponibilités :

    @component('mail::button', ['url' => route('contact.create')])
        Envoyer mes disponibilités
    @endcomponent

    ** Conseil** : Proposez-nous plusieurs créneaux pour faciliter l'organisation du rendez-vous.

    ---

    ## Documents à prévoir

    Pour le jour de l'adoption, pensez à apporter :
    - Une pièce d'identité
    - Un justificatif de domicile
    - Le matériel nécessaire pour transporter {{ $adoption->animal->name }} en toute sécurité

    ---

    Nous sommes impatients de vous rencontrer et de vous voir démarrer cette belle aventure avec {{ $adoption->animal->name }} !

    Merci pour votre engagement envers le bien-être animal,

    L'équipe des **Pattes Heureuses** 🐾

    ---

    *Si vous avez des questions, n'hésitez pas à nous contacter par téléphone ou via notre formulaire de contact.*

    {{ config('app.name') }}
@endcomponent
