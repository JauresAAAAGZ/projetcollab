@extends('layout.apps')

@section('content')
<div class="container">
    <h1>Créer un Projet</h1>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" id="titre" name="titre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="date_debut" class="form-label">Date de Début</label>
            <input type="date" id="date_debut" name="date_debut" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="date_fin" class="form-label">Date de Fin</label>
            <input type="date" id="date_fin" name="date_fin" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="statut" class="form-label">Statut</label>
            <select id="statut" name="statut" class="form-control">
                <option value="en_attente">En Attente</option>
                <option value="en_cours">En Cours</option>
                <option value="termine">Terminé</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
