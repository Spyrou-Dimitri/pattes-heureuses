@component('mail::message')
    # Votre compte bénévole aux Pattes Heureuses !

    **Bonjour {{$newUser->last_name}}**, ci-dessous vous pourrez retrouver vos identifiants afin d'accéder à votre compte bénévole.

    **Email** : {{$newUser->email}}

    **Mot de passe** : password

    Nous vous recommandons très fortement de le changer afin d'établir une meilleure sécurité de votre compte.

    Pour le modifier, veuillez suivre les étapes suivantes :

    1. Vous rendre sur l'espace admin via le **bouton en fin de mail**.
    2. Entrer **vos identifiants**.
    3. Accéder à votre profil ( sur ordi dans le menu en bas, sur téléphone ouvre le burger menu et tout en bas ).
    4. Cliquer sur **"Changer mot de passe"**.
    5. Créer votre nouveau mot de passe.


    Merci pour votre implication dans le projet Pattes-heureuses,


    @component('mail::button', ['url' => 'http://admin.les-pattes-heureuses.test/'])
        Espace admin
    @endcomponent
    {{ config('app.name') }}
@endcomponent
