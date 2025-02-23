@extends('layout.apps')

@section('content')
<div class="container my-5">

    <!-- Success/Error Messages -->
    @if (session('error'))
        <div class="alert alert-danger" id="success-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Project Details Card -->
    <div class="card shadow-lg border-0 rounded">
        <div class="card-body">
            <h1 class="text-center text-primary"><i class="bi bi-folder"></i> {{ $project->titre }}</h1>

            <p class="mt-3"><strong>Description :</strong> {{ $project->description }}</p>

            <p><strong>Statut :</strong> 
                <span class="badge bg-{{ $project->statut == 'en_cours' ? 'primary' : ($project->statut == 'termine' ? 'success' : 'warning') }}">
                    {{ ucfirst(str_replace('_', ' ', $project->statut)) }}
                </span>
            </p>
            
            <p><strong>Date de Début :</strong> 📅 {{ $project->date_debut }}</p>
            <p><strong>Date de Fin :</strong> ⏳ {{ $project->date_fin }}</p>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-center mt-4">
                <a href="{{ url()->previous() }}" class="btn btn-secondary me-2"><i class="bi bi-arrow-left"></i> Retour</a>
                <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning me-2"><i class="bi bi-pencil-square"></i> Modifier</a>
                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer ce projet ?')">
                        <i class="bi bi-trash"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Collaborators Section -->
    <div class="mt-5">
        <h2 class="text-center text-info"><i class="bi bi-people"></i> Gérer les Collaborateurs</h2>
        <div class="card shadow-sm border-0 p-3 mt-3">
            <ul class="list-group">
                @foreach ($project->collaborators as $collaborator)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $collaborator->name }} <span class="badge bg-secondary">{{ ucfirst($collaborator->pivot->role) }}</span></span>
                        <form action="{{ route('projects.removeCollaborator', [$project, $collaborator]) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Retirer ce collaborateur ?')">
                                <i class="bi bi-x-circle"></i> Retirer
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Add Collaborators -->
    <div class="mt-5">
        <h4 class="text-center text-success"><i class="bi bi-person-plus"></i> Ajouter un Collaborateur</h4>
        <div class="card shadow-sm border-0 p-4 mt-3">
            <form action="{{ route('projects.addCollaborator', $project) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="user_id" class="form-label">Sélectionner un utilisateur</label>
                        <select name="user_id" class="form-select" required>
                            <option value="">-- Sélectionner un utilisateur --</option>
                            @foreach (\App\Models\User::all() as $user)
                                @if (!$project->collaborators->contains($user->id))
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="role" class="form-label">Rôle</label>
                        <select name="role" class="form-select" required>
                            <option value="member">Member</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-plus-circle"></i> Ajouter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- Custom Styles -->
<style>
    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        border-radius: 12px;
    }

    .card:hover {
        transform: scale(1.02);
        box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.15);
    }

    .list-group-item {
        transition: background 0.3s;
    }

    .list-group-item:hover {
        background: #f8f9fa;
    }
</style>

@endsection
