<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnneeScolaire extends Model
{
    protected $table = 'annees_scolaires';

    protected $fillable = [
        'libelle',
        'date_debut',
        'date_fin',
        'actif',
    ];

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }

    public static function active(): ?self
    {
        return self::where('actif', true)->first();
    }
}