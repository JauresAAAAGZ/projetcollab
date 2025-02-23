@extends('layout.apps')

@section('content')
<div class="container">
    <h1>Liste des Tâches</h1>
    <a href="{{ route('taches.create') }}" class="btn btn-primary">Ajouter une Tâche</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Projet</th>
                <th>Attribuée à</th>
                <th>Statut</th>
                <th>Date d'échéance</th>
                <th>Fichier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($taches as $tache)
                <tr>
                    <td>{{ $tache->titre }}</td>
                    <td>{{ $tache->project->titre }}</td>
                    <td>{{ $tache->assignedUser->name ?? 'Non attribuée' }}</td>
                    <td>{{ ucfirst($tache->statut) }}</td>
                    <td>
                        @if($tache->date_echeance) 
                        {{ $tache->date_echeance->format('d/m/Y') }}

                        @else
                       Pas de date

                        @endif
                    </td>
                    <td>
                        @if ($tache->file_path)
                        <a href="{{ asset('storage/' . $tache->file_path) }}" target="_blank">Voir Fichier</a>
                        <a href="{{ route('taches.download', $tache->id) }}" class="btn btn-success btn-sm">Télécharger</a>
                        @else
                            Aucun fichier
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('taches.show', $tache) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('taches.edit', $tache) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('taches.destroy', $tache) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette tache ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
