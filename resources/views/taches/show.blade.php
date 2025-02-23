@extends('layout.apps')

@section('content')
<div class="container">
    <h1>Détails de la Tâche</h1>
    <div class="card">
        <div class="card-body">
            <h3>{{ $tache->titre }}</h3>
            <p><strong>Projet:</strong> {{ $tache->project->titre }}</p>
            <p><strong>Description:</strong> {{ $tache->description }}</p>
            <p><strong>Statut:</strong> {{ ucfirst($tache->statut) }}</p>
            <p><strong>Attribuée à:</strong> {{ $tache->assignedTo->name ?? 'Non attribuée' }}</p>
            <p><strong>Date d'échéance:</strong>  
                @if($tache->date_echeance) 
                {{ $tache->date_echeance->format('d/m/Y') }}

                @else
               Pas de date

                @endif</p>
            <p><strong>Description:</strong> {{ $tache->description }}</p>
            @if ($tache->file_path)
                <p><strong>Fichier:</strong> <a href="{{ asset('storage/' . $tache->file_path) }}" target="_blank">Voir</a></p>
            @endif
        </div>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Retour</a>
</div>
@endsection
