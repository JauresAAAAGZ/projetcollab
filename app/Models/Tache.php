<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    /** @use HasFactory<\Database\Factories\TacheFactory> */
    use HasFactory;
    protected $fillable = ['titre', 'description', 'date_echeance', 'statut', 'project_id', 'assigned_to', 'file_path'];

    protected $casts = [
        'date_echeance' => 'date',
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // A task is assigned to a user
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
