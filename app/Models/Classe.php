<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $fillable = [
        'nom', 'niveau_id', 'annee_scolaire_id',
        'effectif_max', 'salle',
    ];

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class);
    }

    public function eleves()
    {
        return $this->hasMany(Eleve::class);
    }
}