@extends('layouts.admin')
@section('title', 'Modifier — '.$eleve->nom_complet)
@section('page-title', 'Modifier le dossier élève')

@section('content')
<div class="card border-0 shadow-sm p-4" style="max-width:860px;">
    <form method="POST" action="{{ route('eleves.update', $eleve) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <h6 class="fw-bold mb-3" style="color:#1a2744;border-bottom:1px solid #e8eaf0;padding-bottom:8px;">
            <i class="bi bi-person me-2"></i>Identité
        </h6>
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <label class="form-label">Nom <span class="text-danger">*</span></label>
                <input type="text" name="nom"
                       class="form-control @error('nom') is-invalid @enderror"
                       value="{{ old('nom', $eleve->nom) }}">
                @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Prénom(s) <span class="text-danger">*</span></label>
                <input type="text" name="prenom"
                       class="form-control @error('prenom') is-invalid @enderror"
                       value="{{ old('prenom', $eleve->prenom) }}">
                @error('prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-2">
                <label class="form-label">Sexe <span class="text-danger">*</span></label>
                <select name="sexe" class="form-select @error('sexe') is-invalid @enderror">
                    <option value="M" {{ old('sexe', $eleve->sexe) == 'M' ? 'selected' : '' }}>Masculin</option>
                    <option value="F" {{ old('sexe', $eleve->sexe) == 'F' ? 'selected' : '' }}>Féminin</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Statut</label>
                <select name="statut" class="form-select">
                    @foreach(['inscrit','transfere','exclu','diplome'] as $s)
                        <option value="{{ $s }}" {{ old('statut', $eleve->statut) == $s ? 'selected' : '' }}>
                            {{ ucfirst($s) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Date de naissance <span class="text-danger">*</span></label>
                <input type="date" name="date_naissance"
                       class="form-control @error('date_naissance') is-invalid @enderror"
                       value="{{ old('date_naissance', $eleve->date_naissance->format('Y-m-d')) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Lieu de naissance</label>
                <input type="text" name="lieu_naissance" class="form-control"
                       value="{{ old('lieu_naissance', $eleve->lieu_naissance) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Classe <span class="text-danger">*</span></label>
                <select name="classe_id" class="form-select @error('classe_id') is-invalid @enderror">
                    @foreach($classes as $classe)
                        <option value="{{ $classe->id }}"
                            {{ old('classe_id', $eleve->classe_id) == $classe->id ? 'selected' : '' }}>
                            {{ $classe->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Nouvelle photo</label>
                <input type="file" name="photo" class="form-control" accept="image/*">
                @if($eleve->photo)
                    <small class="text-muted">Photo actuelle conservée si vide.</small>
                @endif
            </div>
        </div>

        <h6 class="fw-bold mb-3" style="color:#1a2744;border-bottom:1px solid #e8eaf0;padding-bottom:8px;">
            <i class="bi bi-people me-2"></i>Famille
        </h6>
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <label class="form-label">Nom du père</label>
                <input type="text" name="nom_pere" class="form-control"
                       value="{{ old('nom_pere', $eleve->nom_pere) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Nom de la mère</label>
                <input type="text" name="nom_mere" class="form-control"
                       value="{{ old('nom_mere', $eleve->nom_mere) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Téléphone parent</label>
                <input type="text" name="telephone_parent" class="form-control"
                       value="{{ old('telephone_parent', $eleve->telephone_parent) }}">
            </div>
            <div class="col-md-8">
                <label class="form-label">Adresse</label>
                <input type="text" name="adresse" class="form-control"
                       value="{{ old('adresse', $eleve->adresse) }}">
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle me-1"></i>Enregistrer les modifications
            </button>
            <a href="{{ route('eleves.show', $eleve) }}" class="btn btn-outline-secondary">Annuler</a>
        </div>
    </form>
</div>
@endsection