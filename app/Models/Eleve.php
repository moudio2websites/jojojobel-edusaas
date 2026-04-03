<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Eleve extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule', 'nom', 'prenom', 'date_naissance',
        'lieu_naissance', 'sexe', 'classe_id', 'annee_scolaire_id',
        'nom_pere', 'nom_mere', 'telephone_parent',
        'adresse', 'photo', 'statut',
    ];

    protected $casts = [
        'date_naissance' => 'date',
    ];

    // Relations
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function discipline()
    {
        return $this->hasMany(Discipline::class);
    }

    // Accesseurs utiles
    public function getNomCompletAttribute(): string
    {
        return strtoupper($this->nom) . ' ' . ucfirst(strtolower($this->prenom));
    }

    public function getAgeAttribute(): int
    {
        return $this->date_naissance->age;
    }
}