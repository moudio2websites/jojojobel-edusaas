<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    protected $table = 'discipline';

    protected $fillable = [
        'eleve_id', 'annee_scolaire_id', 'type',
        'motif', 'date_faute', 'jours_exclusion', 'signale_par',
    ];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }
}