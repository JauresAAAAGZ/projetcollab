<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();

   // Projets créés par l'utilisateur (Owner)
   $ownedProjects = Project::where('owner_id', $user->id)->get();

   // Projets où l'utilisateur est collaborateur (via la table pivot projectusers)
   $collaboratingProjects = Project::whereHas('collaborators', function ($query) use ($user) {
       $query->where('user_id', $user->id);
   })->get();

    return view('welcome', compact('ownedProjects', 'collaboratingProjects'));
}

}
