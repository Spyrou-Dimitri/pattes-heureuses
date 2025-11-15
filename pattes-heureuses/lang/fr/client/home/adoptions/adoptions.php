<?php

return
    [
        'title' => 'L’<strong>adoption</strong> ? Comment ca fonctionne ?',

        'steps' => [
            'searching' => [
                'title' => 'Cherche votre futur compagnon',
                'content' => 'Explorez les animaux actuellement disponibles à l’adoption et découvrez leurs fiches détaillées : photos, âge, race, caractère et histoire. Prenez le temps de parcourir ceux qui correspondent à votre style de vie et à vos envies. Si un animal attire votre attention, cliquez sur celui-ci pour manifester votre intérêt.',
                'alt' => 'Un homme et une femme qui cherche une information sur leur ordinateur',
                'src' => asset('img/adoptions/step1.jpg'),
                'cta_text' => 'Nos animaux',
                'cta_title' => 'Accéder à la page',
            ],
            'form' => [
                'title' => 'Remplissez votre demande',
                'content' => 'Un court formulaire vous permettra d’exprimer votre souhait d’adopter. Vous y indiquerez vos coordonnées et quelques informations sur votre environnement, afin que nous puissions mieux comprendre vos conditions d’accueil. Une fois la demande envoyée, vous recevrez un email de confirmation attestant que nous l’avons bien reçue.',
                'alt' => 'Un homme et une femme qui cherche une information sur leur ordinateur',
                'src' => asset('img/adoptions/step2.png'),
            ],
            'contact' => [
                'title' => 'Nous vous contactons',
                'content' => 'Notre équipe examine attentivement chaque demande d’adoption. Si votre profil correspond aux besoins de l’animal, nous vous recontacterons par téléphone ou par email pour convenir d’un rendez-vous. Ce premier échange permet aussi de répondre à vos questions avant la rencontre.',
                'alt' => 'Une femme au téléphone',
                'src' => asset('img/adoptions/step3.jpg'),
            ],
            'meeting' => [
                'title' => 'Rencontrez l’animal',
                'content' => 'Lors de votre visite au refuge, vous pourrez rencontrer l’animal, passer un moment avec lui et échanger avec un membre de notre équipe. C’est une étape importante pour vérifier que la relation est positive des deux côtés et que vous formez un bon duo.',
                'alt' => 'Un homme et chien qui se font un top-la',
                'src' => asset('img/adoptions/step4.jpg'),
            ],
            'finish' => [
                'title' => 'Finalisez l’adoption',
                'content' => 'Si tout se passe bien, nous procéderons ensemble aux formalités d’adoption. Une fois les documents signés, vous pourrez repartir avec votre nouveau compagnon. Un email de confirmation vous sera ensuite envoyé pour officialiser votre adoption',
                'alt' => 'Un golden retriever qui fait une balade avec son maitre',
                'src' => asset('img/adoptions/step5.jpg'),
            ],
        ],

    ];
