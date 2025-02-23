@extends('layout.apps')

@section('content')
<div class="container">
    <h1>Ajouter une Tâche</h1>
    <form action="{{ route('taches.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" id="titre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
        </div>
        

        <div class="mb-3">
            <label for="project_id" class="form-label">Projet</label>
            <select name="project_id" id="project_id" class="form-control" required>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->titre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="assigned_to" class="form-label">Attribuée à</label>
            <select name="assigned_to" id="assigned_to" class="form-control">
                <option value="">Sélectionner un utilisateur</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date_echeance" class="form-label">Date d'échéance</label>
            <input type="date" name="date_echeance" id="date_echeance" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="statut" class="form-label">Statut</label>
            <select name="statut" id="statut" class="form-control">
                <option value="suspendue">Suspendue</option>
                <option value="en_cours">En Cours</option>
                <option value="termine">Terminée</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="file_path" class="form-label">Joindre un fichier</label>
            <input type="file" name="file_path" id="file_path" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
