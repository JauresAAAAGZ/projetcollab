<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Mail\TaskAssignedMail;
use Illuminate\Support\Facades\Mail;


class TacheController extends Controller
{
    /**
     * Afficher la liste des tâches.
     */
    public function index()
{
    $user = Auth::user();

    // Récupérer les projets où l'utilisateur est propriétaire (owner)
    $ownedProjects = Project::where('owner_id', $user->id)->pluck('id');

    // Récupérer les projets où l'utilisateur est collaborateur
    $collaboratingProjects = $user->collaborations->pluck('id');

    // Fusionner les deux listes de projets accessibles
    $accessibleProjects = $ownedProjects->merge($collaboratingProjects);

    // Filtrer uniquement les tâches des projets accessibles
    $taches = Tache::whereIn('project_id', $accessibleProjects)
                   ->with(['project', 'assignedUser'])
                   ->get();

    return view('taches.index', compact('taches'));
}


    /**
     * Afficher le formulaire de création d'une tâche.
     */
    public function create()
    {
       // Load all projects with their collaborators
    $projects = Project::with('collaborators')->get(); 

    return view('taches.create', compact('projects'));
    }

    /**
     * Enregistrer une nouvelle tâche.
     */
    public function store(Request $request)
{
    $request->validate([
        'titre' => 'required',
        'description' => 'required',
        'date_echeance' => 'required|date',
        'project_id' => 'required|exists:projects,id',
        'file_path' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
        'assigned_to' => 'nullable|exists:users,id',
        'statut' => 'required|in:suspendue,en_cours,termine',
    ]);

    // File Upload
    $filePath = null;
    if ($request->hasFile('file_path')) {
        $filePath = $request->file('file_path')->store('taches_files', 'public');
    }

    // Create Task
    $tache = Tache::create([
        'titre' => $request->titre,
        'description' => $request->description,
        'date_echeance'=> $request->date_echeance,
        'project_id' => $request->project_id,
        'assigned_to' => $request->assigned_to,
        'file_path' => $filePath,
        'statut' => $request->statut,
    ]);

    // Send email if a user is assigned
    if ($tache->assigned_to) {
        $assignedUser = User::find($tache->assigned_to);
        Mail::to($assignedUser->email)->send(new TaskAssignedMail($tache));
    }

    return redirect()->route('taches.index')->with('success', 'Tâche créée avec succès.');
}

    /**
     * Afficher une tâche.
     */
    public function show(Tache $tache)
    {
        
        return view('taches.show', compact('tache'));
    }

    /**
     * Afficher le formulaire de modification d'une tâche.
     */
    public function edit(Tache $tache)
    {
        $project = Project::with('collaborators')->findOrFail($tache->project_id);

        return view('taches.edit', compact('tache', 'project'));
    }

    /**
     * Mettre à jour une tâche.
     */
    public function update(Request $request, Tache $tache)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'assigned_to' => 'nullable|exists:users,id',
            'file_path' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        // Gestion du fichier mis à jour
        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('taches_files', 'public');
            $tache->file_path = $filePath;
        }

        // Mise à jour de la tâche
        $tache->update([
            'titre' => $request->titre,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
        ]);

         // Send email if a user is assigned
    if ($tache->assigned_to) {
        $assignedUser = User::find($tache->assigned_to);
        Mail::to($assignedUser->email)->send(new TaskAssignedMail($tache));
    }


        return redirect()->route('taches.index')->with('success', 'Tâche mise à jour avec succès.');
    }

    /**
     * Supprimer une tâche.
     */
    public function destroy(Tache $tache)
    {
        $tache->delete();
        return redirect()->route('taches.index')->with('success', 'Tâche supprimée avec succès.');
    }

    public function tasksByProject(Project $project)
{
    // Récupérer uniquement les tâches liées au projet
    $taches = $project->taches()->with('assignedUser')->orderBy('statut', 'asc')->get();

    return view('taches.tachespe', compact('taches', 'project'));
}

public function download($id)
{
    $tache = Tache::findOrFail($id);

    if ($tache->file_path && Storage::disk('public')->exists($tache->file_path)) {
        $filePath = storage_path('app/public/' . $tache->file_path);
        return response()->download($filePath);
    }

    return redirect()->back()->with('error', 'Fichier non trouvé.');
}



}
