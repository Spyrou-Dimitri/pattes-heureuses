@component('mail::message')
    # Nouvelle demande d'adoption !

    **Bonjour,**

    Une nouvelle demande d'adoption vient d'être soumise pour **{{ $adoption->animal->name }}**.

    ## Informations sur l'adoptant

    **Nom complet** : {{ $adoption->first_name }} {{ $adoption->last_name }}

    **Email** : {{ $adoption->email }}

    **Téléphone** : {{ $adoption->telephone ?? 'Non spécifié' }}

    ## Informations sur l'animal

    **Nom** : {{ $adoption->animal->name }}

    **Espèce** : {{ $adoption->animal->breed->specie->name }}

    **Race** : {{ $adoption->animal->breed->name }}

    **Âge** : {{ $adoption->animal->age }} an(s)

    **Sexe** : {{ $adoption->animal->sexe }}

    ## 🏠 Informations complémentaires

    @if($adoption->housing_type)
        **Type de logement** : {{ $adoption->housing_type }}
    @endif

    @if($adoption->environment)
        **Environnement** : {{ $adoption->environment }}
    @endif

    @if($adoption->motivations)
        **Motivations** :

        {{ $adoption->motivations }}
    @endif

    ---

    **Date de la demande** : {{ $adoption->created_at->format('d/m/Y à H:i') }}

    @component('mail::button', ['url' => route('adoptions-show', $adoption->id)])
        Voir la demande d'adoption
    @endcomponent

    Merci,

    {{ config('app.name') }}
@endcomponent
