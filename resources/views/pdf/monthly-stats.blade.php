<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
            color: #333;
            margin: 30px;
        }

        .header {
            border-bottom: 1px solid #999;
            margin-bottom: 25px;
            padding-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
        }

        .header p {
            margin: 5px 0 0 0;
            font-size: 11px;
        }

        h1 {
            font-size: 20px;
            margin: 20px 0;
        }

        .stats-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
        }

        .stats-table th,
        .stats-table td {
            border: 1px solid #999;
            padding: 12px;
            text-align: center;
        }

        .stats-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .stats-table td {
            font-size: 16px;
        }

        .context {
            margin-top: 20px;
            line-height: 1.6;
            text-align: justify;
        }

        .signature {
            margin-top: 40px;
        }

        .footer {
            position: fixed;
            bottom: 15px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>

<div class="header">
    <h2>Refuge animalier – Rapport d’activité</h2>
    <p>
        Mois concerné : <strong>{{ $month ?? 'Avril 2025' }}</strong><br>
        Émetteur : <strong>Refuge de Élise</strong>
    </p>
</div>

<h1>Statistiques mensuelles</h1>

<table class="stats-table">
    <thead>
    <tr>
        <th>Animaux accueillis</th>
        <th>Adoptions réalisées</th>
        <th>Animaux présents au refuge</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $animals }}</td>
        <td>{{ $adoptions }}</td>
        <td>{{ $current_animals }}</td>
    </tr>
    </tbody>
</table>

<p class="context">
    Le présent rapport a pour objectif de présenter les principales
    statistiques d’activité du refuge pour le mois écoulé.
    Ces données sont transmises à la commune dans le cadre du suivi
    de l’agrément et de la participation financière accordée
    pour l’exploitation du refuge.
</p>

<div class="signature">
    <p>
        Fait le {{ $generatedAt ?? '1er mai 2025' }}<br><br>
        <strong>Élise</strong><br>
        Responsable du refuge
    </p>
</div>

<div class="footer">
    Rapport généré automatiquement depuis le tableau de bord du refuge
</div>

</body>
</html>
