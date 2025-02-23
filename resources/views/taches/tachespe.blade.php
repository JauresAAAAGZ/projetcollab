@extends('layout.apps')

@section('content')
<div class="container">
    <h1 class="mb-4">📋 Tâches du Projet: {{ $project->titre }}</h1>

    <a href="{{ route('projects.index') }}" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left"></i> Retour aux Projets</a>

    <div class="card shadow-sm border-0 p-4">
        <h3 class="text-primary">Liste des Tâches</h3>

        @if ($taches->isEmpty())
            <p class="text-muted">Aucune tâche pour ce projet.</p>
        @else
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Statut</th>
                        <th>Assigné à</th>
                        <th>Date Limite</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($taches as $tache)
                        <tr>
                            <td>{{ $tache->id }}</td>
                            <td>{{ $tache->titre }}</td>
                            <td>
                                <span class="badge bg-{{ $tache->statut == 'en_cours' ? 'primary' : ($tache->statut == 'termine' ? 'success' : 'warning') }}">
                                    {{ ucfirst($tache->statut) }}
                                </span>
                            </td>
                            <td>{{ $tache->assignedUser->name ?? 'Non assigné' }}</td>
                            <td>{{ $tache->date_echeance }}</td>
                            <td>
                                <a href="{{ route('taches.show', $tache) }}" class="btn btn-info btn-sm">Détails</a>
                                <a href="{{ route('taches.edit', $tache) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('taches.destroy', $tache) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette tâche ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
