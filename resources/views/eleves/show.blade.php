@extends('layouts.admin')
@section('title', $eleve->nom_complet)
@section('page-title', 'Fiche élève')

@section('content')
<div class="row g-4">

    {{-- Colonne gauche : identité --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 text-center">

            @if($eleve->photo)
                <img src="{{ asset('storage/'.$eleve->photo) }}"
                     class="rounded-circle mx-auto mb-3"
                     style="width:90px;height:90px;object-fit:cover;">
            @else
                <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                     style="width:90px;height:90px;background:#e8f0fe;font-size:32px;font-weight:700;color:#4f8ef7;">
                    {{ strtoupper(substr($eleve->prenom,0,1)) }}
                </div>
            @endif

            <h5 class="fw-bold mb-0" style="color:#1a2744;">{{ $eleve->nom_complet }}</h5>
            <p class="text-muted mb-1" style="font-size:13px;">{{ $eleve->classe?->nom ?? 'Sans classe' }}</p>
            <code style="font-size:12px;color:#4f8ef7;">{{ $eleve->matricule }}</code>

            <div class="mt-3">
                @php
                    $colors = ['inscrit'=>'success','transfere'=>'warning','exclu'=>'danger','diplome'=>'info'];
                @endphp
                <span class="badge bg-{{ $colors[$eleve->statut] ?? 'secondary' }} px-3 py-2">
                    {{ ucfirst($eleve->statut) }}
                </span>
            </div>

            <hr>
            <div class="text-start" style="font-size:13px;">
                <div class="mb-2">
                    <span class="text-muted">Sexe :</span>
                    <strong>{{ $eleve->sexe == 'M' ? 'Masculin' : 'Féminin' }}</strong>
                </div>
                <div class="mb-2">
                    <div class="mb-2">
    <span class="text-muted">Naissance :</span>
    <strong>
        {{ $eleve->date_naissance ? $eleve->date_naissance->format('d/m/Y') : '–' }}
    </strong>
</div>
<div class="mb-2">
    <span class="text-muted">Lieu :</span>
    <strong>{{ $eleve->lieu_naissance ?? '–' }}</strong>
</div>
<div class="mb-2">
    <span class="text-muted">Âge :</span>
    <strong>
        {{ $eleve->date_naissance ? $eleve->date_naissance->age . ' ans' : '–' }}
    </strong>
</div>
            </div>

            <div class="d-flex gap-2 mt-3">
                <a href="{{ route('eleves.edit', $eleve) }}"
                   class="btn btn-outline-primary btn-sm flex-fill">
                    <i class="bi bi-pencil me-1"></i>Modifier
                </a>
                <form method="POST" action="{{ route('eleves.destroy', $eleve) }}"
                      onsubmit="return confirm('Supprimer cet élève ?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Colonne droite : détails --}}
    <div class="col-md-8">

        {{-- Famille --}}
        <div class="card border-0 shadow-sm p-4 mb-3">
            <h6 class="fw-bold mb-3" style="color:#1a2744;">
                <i class="bi bi-people me-2"></i>Informations famille
            </h6>
            <div class="row g-2" style="font-size:13px;">
                <div class="col-md-6">
                    <span class="text-muted">Père :</span>
                    <strong>{{ $eleve->nom_pere ?? '–' }}</strong>
                </div>
                <div class="col-md-6">
                    <span class="text-muted">Mère :</span>
                    <strong>{{ $eleve->nom_mere ?? '–' }}</strong>
                </div>
                <div class="col-md-6">
                    <span class="text-muted">Téléphone :</span>
                    <strong>{{ $eleve->telephone_parent ?? '–' }}</strong>
                </div>
                <div class="col-md-6">
                    <span class="text-muted">Adresse :</span>
                    <strong>{{ $eleve->adresse ?? '–' }}</strong>
                </div>
            </div>
        </div>

        {{-- Paiements --}}
        <div class="card border-0 shadow-sm p-4 mb-3">
            <h6 class="fw-bold mb-3" style="color:#1a2744;">
                <i class="bi bi-cash-coin me-2"></i>Scolarité
            </h6>
            @if($eleve->paiements->count())
                <table class="table table-jojo table-sm mb-0">
                    <thead>
                        <tr>
                            <th>Tranche</th>
                            <th>Montant</th>
                            <th>Date</th>
                            <th>Mode</th>
                            <th>Reçu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($eleve->paiements as $p)
                        <tr>
                            <td>Tranche {{ $p->numero_tranche }}</td>
                            <td>{{ number_format($p->montant, 0, ',', ' ') }} FCFA</td>
                            <td>{{ \Carbon\Carbon::parse($p->date_paiement)->format('d/m/Y') }}</td>
                            <td>{{ ucfirst(str_replace('_',' ',$p->mode_paiement)) }}</td>
                            <td><code style="font-size:11px;">{{ $p->numero_recu }}</code></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted mb-0" style="font-size:13px;">
                    <i class="bi bi-info-circle me-1"></i>Aucun paiement enregistré.
                </p>
            @endif
        </div>

        {{-- Discipline --}}
        <div class="card border-0 shadow-sm p-4">
            <h6 class="fw-bold mb-3" style="color:#1a2744;">
                <i class="bi bi-exclamation-triangle me-2"></i>Discipline
            </h6>
            @if($eleve->discipline->count())
                @foreach($eleve->discipline as $d)
                <div class="d-flex justify-content-between align-items-start mb-2 pb-2 border-bottom">
                    <div>
                        <span class="badge bg-{{ in_array($d->type,['felicitations','encouragements']) ? 'success' : 'danger' }} me-2">
                            {{ ucfirst(str_replace('_',' ',$d->type)) }}
                        </span>
                        <span style="font-size:13px;">{{ $d->motif }}</span>
                    </div>
                    <small class="text-muted">
                        {{ \Carbon\Carbon::parse($d->date_faute)->format('d/m/Y') }}
                    </small>
                </div>
                @endforeach
            @else
                <p class="text-muted mb-0" style="font-size:13px;">
                    <i class="bi bi-check-circle me-1 text-success"></i>Aucun dossier disciplinaire.
                </p>
            @endif
        </div>

    </div>
</div>
@endsection