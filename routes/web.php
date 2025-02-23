<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
->middleware(['auth', 'verified'])
->name('dash');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


    Route::resource('users', UserController::class);


Route::resource('projects', ProjectController::class)->middleware('auth');


Route::post('/projects/{project}/collaborators', [ProjectController::class, 'addCollaborator'])->name('projects.addCollaborator');
Route::delete('/projects/{project}/collaborators/{user}', [ProjectController::class, 'removeCollaborator'])->name('projects.removeCollaborator');

Route::get('/projects/{project}/taches', [TacheController::class, 'tasksByProject'])->name('projects.taches');

Route::get('/taches/{id}/download', [App\Http\Controllers\TacheController::class, 'download'])->name('taches.download');

// Display a list of tasks
Route::get('/taches', [TacheController::class, 'index'])
    ->name('taches.index')
    ->middleware('auth');

// Show the form for creating a new task
Route::get('/taches/create', [TacheController::class, 'create'])
    ->name('taches.create')
    ->middleware('auth');

// Store a newly created task in the database
Route::post('/taches', [TacheController::class, 'store'])
    ->name('taches.store')
    ->middleware('auth');

// Display a specific task
Route::get('/taches/{tache}', [TacheController::class, 'show'])
    ->name('taches.show')
    ->middleware('auth');

// Show the form for editing a specific task
Route::get('/taches/{tache}/edit', [TacheController::class, 'edit'])
    ->name('taches.edit')
    ->middleware('auth');

// Update a specific task in the database
Route::put('/taches/{tache}', [TacheController::class, 'update'])
    ->name('taches.update')
    ->middleware('auth');

// Delete a specific task from the database
Route::delete('/taches/{tache}', [TacheController::class, 'destroy'])
    ->name('taches.destroy')
    ->middleware('auth');


    

require __DIR__.'/auth.php';
