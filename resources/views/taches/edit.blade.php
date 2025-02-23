@extends('layout.apps')

@section('content')
<div class="container">
    <h1>Modifier la Tâche</h1>
    <form action="{{ route('taches.update', $tache->id) }}" method="POST" enctype="multipart/form-data">
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
            <label for="assigned_to" class="form-label">Assigner à</label>
            <select name="assigned_to" id="assigned_to" class="form-control">
                <option value="">Non attribuée</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $tache->assigned_to == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
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
            <label for="file_path" class="form-label">Changer le fichier</label>
            <input type="file" name="file_path" id="file_path" class="form-control">
            @if ($tache->file_path)
                <p>Fichier actuel: <a href="{{ asset('storage/' . $tache->file_path) }}" target="_blank">Voir</a></p>
            @endif
        </div>

        <button type="submit" class="btn btn-warning">Modifier</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
