<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'eleve_id', 'annee_scolaire_id', 'numero_tranche',
        'montant', 'date_paiement', 'numero_recu',
        'mode_paiement', 'encaisse_par', 'observation',
    ];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }

    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class);
    }
}