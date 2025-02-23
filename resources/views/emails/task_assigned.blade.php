<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle Tâche Assignée</title>
</head>
<body>
    <h2>Bonjour {{ $tache->assignedUser->name }},</h2>

    <p>Une nouvelle tâche vous a été assignée dans le projet <strong>{{ $tache->project->titre }}</strong>.</p>

    <p><strong>Titre :</strong> {{ $tache->titre }}</p>
    <p><strong>Description :</strong> {{ $tache->description }}</p>
    <p><strong>Date d'échéance :</strong> {{ $tache->date_echeance }}</p>

    <p>Vous pouvez voir la tâche ici : <a href="{{ route('taches.show', $tache) }}">Voir la tâche</a></p>

    <p>Merci,</p>
    <p>L'équipe de gestion de projets</p>
</body>
</html>
