@extends('layout.apps')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des Projets</h1>

    @if (session('success'))
        <div class="alert alert-success" id="success-alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" id="success-danger">
            {{ session('error') }}
        </div>
    @endif
    

    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Créer un Projet</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>N°</th>
                <th>Titre</th>
                <th>Créé Par</th>
                <th>Collabrateurs</th>
                <th>Statut</th>
                <th>Date Début</th>
                <th>Date Fin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->titre }}</td>
                    <td>{{$project->owner->name ?? 'Unknown'}}</td>

                    <td>
                        <ul>
                            @forelse ($project->collaborators as $collaborator)
                                <li>{{ $collaborator->name }} ({{ $collaborator->pivot->role }})</li>
                            @empty
                                <li>Pas de collaborateurs</li>
                            @endforelse
                        </ul>
                    </td>
                    <td>
                        <span class="badge bg-{{ $project->statut == 'en_cours' ? 'primary' : ($project->statut == 'termine' ? 'success' : 'warning') }}">
                            {{ ucfirst(str_replace('_', ' ', $project->statut)) }}
                        </span>
                    </td>
                    <td>{{ $project->date_debut }}</td>
                    <td>{{ $project->date_fin }}</td>

                    
                    <td>
                        <a href="{{ route('projects.taches', $project) }}" class="btn btn-success btn-sm">
                            <i class="bi bi-list-task"></i> Voir Tâches
                        </a>
                        <a href="{{ route('projects.show', $project) }}" class="btn btn-info btn-sm">options</a>
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce projet ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection
