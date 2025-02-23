@extends('layout.apps')

@section('content')
<div class="container">
    <h1>Modifier la Tâche</h1>
    <form action="{{ route('taches.update', $tache) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" id="titre" class="form-control" value="{{ $tache->titre }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ $tache->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="project_id" class="form-label">Projet</label>
            <select name="project_id" id="project_id" class="form-control" required disabled>
                <option value="{{ $project->id }}">{{ $project->titre }}</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="assigned_to" class="form-label">Attribuée à</label>
            <select name="assigned_to" id="assigned_to" class="form-control">
                <option value="">Sélectionner un collaborateur</option>
                @foreach ($project->collaborators as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $tache->assigned_to ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date_echeance" class="form-label">Date d'échéance</label>
            <input type="date" name="date_echeance" id="date_echeance" class="form-control"
                   value="{{ $tache->date_echeance }}" required max="{{ $project->date_fin }}" min="{{ $project->date_debut }}">
        </div>

        <div class="mb-3">
            <label for="statut" class="form-label">Statut</label>
            <select name="statut" id="statut" class="form-control">
                <option value="suspendue" {{ $tache->statut == 'suspendue' ? 'selected' : '' }}>Suspendue</option>
                <option value="en_cours" {{ $tache->statut == 'en_cours' ? 'selected' : '' }}>En Cours</option>
                <option value="termine" {{ $tache->statut == 'termine' ? 'selected' : '' }}>Terminée</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="file_path" class="form-label">Joindre un fichier</label>
            <input type="file" name="file_path" id="file_path" class="form-control">
            @if ($tache->file_path)
                <p>Fichier actuel: <a href="{{ asset('storage/' . $tache->file_path) }}" target="_blank">Voir fichier</a></p>
            @endif
        </div>

        <button type="submit" class="btn btn-success">Mettre à jour</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<!-- JavaScript pour empêcher la date d'échéance d'être supérieure à la date de fin du projet -->
<script>
    document.getElementById('date_echeance').addEventListener('change', function() {
        let projectEndDate = "{{ $project->date_fin }}";
        if (this.value > projectEndDate) {
            alert("La date d'échéance ne peut pas dépasser la date de fin du projet (" + projectEndDate + ").");
            this.value = projectEndDate; // Ajuste la date automatiquement
        }
    });
</script>

@endsection
