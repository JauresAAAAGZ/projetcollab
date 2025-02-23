<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = ['titre', 'description', 'date_debut', 'date_fin', 'statut','owner_id'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function collaborators()
    {
        return $this->belongsToMany(User::class, 'projectusers')->withPivot('role')->withTimestamps();
    }
    
    public function taches()
    {
        return $this->hasMany(Tache::class);
    }

}
