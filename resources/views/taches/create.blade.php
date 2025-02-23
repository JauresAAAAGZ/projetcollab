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
                <option value="">Sélectionner un projet</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}" 
                            data-end-date="{{ $project->date_fin }}"
                            data-collaborators="{{ json_encode($project->collaborators->pluck('id', 'name')) }}">
                        {{ $project->titre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="assigned_to" class="form-label">Attribuée à</label>
            <select name="assigned_to" id="assigned_to" class="form-control">
                <option value="">Sélectionner un collaborateur</option>
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

<!-- JavaScript pour mettre à jour la liste des collaborateurs et restreindre la date d'échéance -->
<script>
    document.getElementById('project_id').addEventListener('change', function () {
        let selectedProject = this.options[this.selectedIndex];
        let endDate = selectedProject.getAttribute('data-end-date');
        let collaborators = JSON.parse(selectedProject.getAttribute('data-collaborators') || '{}');

        // Mettre à jour la date max pour la date d'échéance
        let dateInput = document.getElementById('date_echeance');
        dateInput.max = endDate;
        dateInput.value = ""; // Réinitialiser la valeur sélectionnée

        // Mettre à jour la liste des collaborateurs
        let assignedToSelect = document.getElementById('assigned_to');
        assignedToSelect.innerHTML = '<option value="">Sélectionner un collaborateur</option>';

        Object.keys(collaborators).forEach(name => {
            let userId = collaborators[name];
            let option = document.createElement('option');
            option.value = userId;
            option.textContent = name;
            assignedToSelect.appendChild(option);
        });
    });

    // Vérifier que la date d'échéance ne dépasse pas la date de fin du projet
    document.getElementById('date_echeance').addEventListener('change', function() {
        let selectedProject = document.getElementById('project_id').options[document.getElementById('project_id').selectedIndex];
        let endDate = selectedProject.getAttribute('data-end-date');

        if (this.value > endDate) {
            alert("La date d'échéance ne peut pas dépasser la date de fin du projet (" + endDate + ").");
            this.value = endDate; // Ajuster automatiquement la date
        }
    });
</script>

@endsection
