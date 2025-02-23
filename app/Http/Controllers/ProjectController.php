<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\CollaboratorAddedMail;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{
    /**
     * Affiche la liste des projets
     */
    public function index()
    {
        $projects = Project::with(['owner', 'collaborators'])->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * Affiche le formulaire de création d'un projet
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Stocke un nouveau projet en base de données
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'statut' => 'required|in:en_attente,en_cours,termine',
        ]);

        Project::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'statut' => $request->statut,
            'owner_id' => Auth::id(), // L'utilisateur connecté devient propriétaire du projet
        ]);

        return redirect()->route('projects.index')->with('success', 'Projet créé avec succès.');
    }

    /**
     * Affiche un projet spécifique
     */
    public function show(Project $project)
    {
        $project->load('owner');
        return view('projects.show', compact('project'));
    }

    /**
     * Affiche le formulaire d'édition d'un projet
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Met à jour un projet
     */
    public function update(Request $request, Project $project)
{
    $user = Auth::user();
    
    // Vérifier si l'utilisateur est propriétaire OU admin du projet
    if ($project->owner_id !== $user->id && 
        !$project->collaborators()->wherePivot('user_id', $user->id)->wherePivot('role', 'admin')->exists()) {
        return redirect()->route('projects.show', $project)->with('error', 'Seuls les administrateurs ou le propriétaire peuvent modifier ce projet.');
    }

    $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'nullable|string',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after_or_equal:date_debut',
        'statut' => 'required|in:en_attente,en_cours,termine',
    ]);

    $project->update($request->all());

    return redirect()->route('projects.index')->with('success', 'Projet mis à jour avec succès.');
}

    

    /**
     * Supprime un projet
     */
    public function destroy(Project $project)
{
    $user = Auth::user();

    // Vérifier si l'utilisateur est le propriétaire du projet
    if ($project->owner_id !== $user->id) {
        return redirect()->route('projects.show', $project)->with('error', 'Seul le propriétaire peut supprimer ce projet.');
    }

    $project->delete();

    return redirect()->route('projects.index')->with('success', 'Projet supprimé avec succès.');
}

    
public function addCollaborator(Request $request, Project $project)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'role' => 'required|in:admin,member',
    ]);

    // Check if the authenticated user is the project owner or an admin collaborator
    $user = Auth::user();
    if ($project->owner_id !== $user->id && 
        !$project->collaborators()->wherePivot('user_id', $user->id)->wherePivot('role', 'admin')->exists()) {
        return redirect()->route('projects.show', $project)->with('error', 'Seuls les administrateurs peuvent ajouter des membres.');
    }

    // Check if the user is already a collaborator
    if ($project->collaborators()->wherePivot('user_id', $request->user_id)->exists()) {
        return redirect()->route('projects.show', $project)->with('error', 'Cet utilisateur est déjà collaborateur.');
    }

    // Add the user as a collaborator
    $project->collaborators()->attach($request->user_id, ['role' => $request->role]);

    // Get the user who was just added
    $newCollaborator = User::find($request->user_id);

    if (!$newCollaborator) {
        return redirect()->route('projects.show', $project)
                        ->with('error', 'Utilisateur introuvable.');
    }

    // Send notification email
    Mail::to($newCollaborator->email)->send(new CollaboratorAddedMail($project, $newCollaborator));


    return redirect()->route('projects.show', $project)->with('success', 'Collaborateur ajouté avec succès.');
}
    


    public function removeCollaborator(Project $project, User $user)
{
    $admin = Auth::user();

    // Vérifier si l'utilisateur est propriétaire OU admin du projet
    if ($project->owner_id !== $admin->id && 
        !$project->collaborators()->wherePivot('user_id', $admin->id)->wherePivot('role', 'admin')->exists()) {
        return redirect()->route('projects.show', $project)->with('error', 'Seuls les administrateurs ou le propriétaire peuvent retirer un collaborateur.');
    }

    // Vérifier si l'utilisateur à retirer est bien un collaborateur du projet
    if (!$project->collaborators()->wherePivot('user_id', $user->id)->exists()) {
        return redirect()->route('projects.show', $project)->with('error', 'Cet utilisateur n\'est pas un collaborateur du projet.');
    }

    $project->collaborators()->detach($user->id);

    return redirect()->route('projects.show', $project)->with('success', 'Collaborateur retiré avec succès.');
}
////////
    
}

