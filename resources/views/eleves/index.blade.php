@extends('layouts.admin')
@section('title', 'Élèves')
@section('page-title', 'Liste des élèves')

@section('content')

{{-- Barre de recherche et filtres --}}
<div class="card border-0 shadow-sm mb-4 p-3">
    <form method="GET" action="{{ route('eleves.index') }}" class="row g-2 align-items-end">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control form-control-sm"
                   placeholder="Rechercher nom, prénom, matricule..."
                   value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="classe_id" class="form-select form-select-sm">
                <option value="">Toutes les classes</option>
                @foreach($classes as $classe)
                    <option value="{{ $classe->id }}"
                        {{ request('classe_id') == $classe->id ? 'selected' : '' }}>
                        {{ $classe->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="sexe" class="form-select form-select-sm">
                <option value="">Tous</option>
                <option value="M" {{ request('sexe') == 'M' ? 'selected' : '' }}>Garçons</option>
                <option value="F" {{ request('sexe') == 'F' ? 'selected' : '' }}>Filles</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="bi bi-search me-1"></i>Filtrer
            </button>
            <a href="{{ route('eleves.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-x"></i>
            </a>
            <a href="{{ route('eleves.create') }}" class="btn btn-success btn-sm ms-auto">
                <i class="bi bi-person-plus me-1"></i>Nouvel élève
            </a>
        </div>
    </form>
</div>

{{-- Tableau --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <span class="fw-semibold" style="color:#1a2744;">
            <i class="bi bi-people me-2"></i>
            {{ $eleves->total() }} élève(s) trouvé(s)
        </span>
    </div>
    <div class="table-responsive">
        <table class="table table-jojo table-hover mb-0">
            <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Nom complet</th>
                    <th>Sexe</th>
                    <th>Classe</th>
                    <th>Parent / Tuteur</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($eleves as $eleve)
                <tr>
                    <td>
                        <code style="font-size:12px;color:#4f8ef7;">{{ $eleve->matricule }}</code>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            @if($eleve->photo)
                                <img src="{{ asset('storage/'.$eleve->photo) }}"
                                     class="rounded-circle" width="32" height="32"
                                     style="object-fit:cover;">
                            @else
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                     style="width:32px;height:32px;background:#e8f0fe;color:#4f8ef7;font-size:12px;font-weight:600;">
                                    {{ strtoupper(substr($eleve->prenom,0,1)) }}
                                </div>
                            @endif
                            <div>
                                <div class="fw-semibold" style="font-size:13px;">{{ $eleve->nom_complet }}</div>
                                <div style="font-size:11px;color:#8a93a6;">
                                    {{ $eleve->date_naissance->format('d/m/Y') }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge {{ $eleve->sexe == 'M' ? 'bg-info' : 'bg-pink' }} text-white">
                            {{ $eleve->sexe == 'M' ? 'Garçon' : 'Fille' }}
                        </span>
                    </td>
                    <td>{{ $eleve->classe?->nom ?? '–' }}</td>
                    <td style="font-size:12px;">
                        {{ $eleve->telephone_parent ?? '–' }}
                    </td>
                    <td>
                        @php
                            $colors = [
                                'inscrit'  => 'success',
                                'transfere'=> 'warning',
                                'exclu'    => 'danger',
                                'diplome'  => 'info',
                            ];
                        @endphp
                        <span class="badge bg-{{ $colors[$eleve->statut] ?? 'secondary' }}">
                            {{ ucfirst($eleve->statut) }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('eleves.show', $eleve) }}"
                           class="btn btn-sm btn-outline-primary" title="Voir">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('eleves.edit', $eleve) }}"
                           class="btn btn-sm btn-outline-secondary" title="Modifier">
                            <i class="bi bi-pencil"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="bi bi-people" style="font-size:32px;"></i>
                        <p class="mt-2">Aucun élève trouvé.<br>
                            <a href="{{ route('eleves.create') }}">Inscrire le premier élève</a>
                        </p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($eleves->hasPages())
    <div class="card-footer bg-white">
        {{ $eleves->links() }}
    </div>
    @endif
</div>
@endsection