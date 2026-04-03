<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Classe;
use App\Models\AnneeScolaire;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EleveController extends Controller
{
    public function index(Request $request)
    {
        $annee   = AnneeScolaire::active();
        $classes = Classe::where('annee_scolaire_id', $annee?->id)
                         ->orderBy('nom')->get();

        $eleves = Eleve::with('classe')
            ->when($request->search, fn($q) =>
                $q->where('nom', 'like', "%{$request->search}%")
                  ->orWhere('prenom', 'like', "%{$request->search}%")
                  ->orWhere('matricule', 'like', "%{$request->search}%")
            )
            ->when($request->classe_id, fn($q) =>
                $q->where('classe_id', $request->classe_id)
            )
            ->when($request->sexe, fn($q) =>
                $q->where('sexe', $request->sexe)
            )
            ->when($annee, fn($q) =>
                $q->where('annee_scolaire_id', $annee->id)
            )
            ->orderBy('nom')
            ->paginate(25)
            ->withQueryString();

        return view('eleves.index', compact('eleves', 'classes', 'annee'));
    }

    public function create()
    {
        $annee   = AnneeScolaire::active();
        $classes = Classe::where('annee_scolaire_id', $annee?->id)
                         ->orderBy('nom')->get();
        return view('eleves.create', compact('classes', 'annee'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'              => 'required|string|max:100',
            'prenom'           => 'required|string|max:100',
            'date_naissance'   => 'required|date|before:today',
            'lieu_naissance'   => 'nullable|string|max:100',
            'sexe'             => 'required|in:M,F',
            'classe_id'        => 'required|exists:classes,id',
            'nom_pere'         => 'nullable|string|max:100',
            'nom_mere'         => 'nullable|string|max:100',
            'telephone_parent' => 'nullable|string|max:20',
            'adresse'          => 'nullable|string|max:200',
            'photo'            => 'nullable|image|max:2048',
        ]);

        $annee = AnneeScolaire::active();

        // Générer le matricule automatiquement
        $anneeCode  = substr($annee->libelle, 0, 4);
        $dernierNum = Eleve::whereYear('created_at', now()->year)->count() + 1;
        $validated['matricule']        = 'EL' . $anneeCode . str_pad($dernierNum, 4, '0', STR_PAD_LEFT);
        $validated['annee_scolaire_id'] = $annee->id;

        // Upload photo
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('eleves/photos', 'public');
        }

        $eleve = Eleve::create($validated);

        return redirect()->route('eleves.show', $eleve)
            ->with('success', "Élève {$eleve->nom_complet} inscrit avec succès. Matricule : {$eleve->matricule}");
    }

    public function show(Eleve $eleve)
    {
        $eleve->load('classe.niveau', 'paiements', 'discipline');
        return view('eleves.show', compact('eleve'));
    }

    public function edit(Eleve $eleve)
    {
        $annee   = AnneeScolaire::active();
        $classes = Classe::where('annee_scolaire_id', $annee?->id)
                         ->orderBy('nom')->get();
        return view('eleves.edit', compact('eleve', 'classes'));
    }

    public function update(Request $request, Eleve $eleve)
    {
        $validated = $request->validate([
            'nom'              => 'required|string|max:100',
            'prenom'           => 'required|string|max:100',
            'date_naissance'   => 'required|date|before:today',
            'lieu_naissance'   => 'nullable|string|max:100',
            'sexe'             => 'required|in:M,F',
            'classe_id'        => 'required|exists:classes,id',
            'nom_pere'         => 'nullable|string|max:100',
            'nom_mere'         => 'nullable|string|max:100',
            'telephone_parent' => 'nullable|string|max:20',
            'adresse'          => 'nullable|string|max:200',
            'statut'           => 'required|in:inscrit,transfere,exclu,diplome',
            'photo'            => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('eleves/photos', 'public');
        }

        $eleve->update($validated);

        return redirect()->route('eleves.show', $eleve)
            ->with('success', 'Dossier mis à jour avec succès.');
    }

    public function destroy(Eleve $eleve)
    {
        $nom = $eleve->nom_complet;
        $eleve->delete();
        return redirect()->route('eleves.index')
            ->with('success', "Élève {$nom} supprimé.");
    }
}