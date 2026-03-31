@extends('layouts.admin')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="label"><i class="bi bi-people me-1"></i>Total élèves</div>
            <div class="value">0</div>
            <div class="sub text-muted">Aucune inscription</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="label"><i class="bi bi-building me-1"></i>Classes actives</div>
            <div class="value">0</div>
            <div class="sub text-muted">–</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="label"><i class="bi bi-cash me-1"></i>Scolarité collectée</div>
            <div class="value">0%</div>
            <div class="sub text-warning">0 impayé</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="label"><i class="bi bi-exclamation-triangle me-1"></i>Discipline</div>
            <div class="value">0</div>
            <div class="sub text-danger">0 exclusion</div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm p-4 text-center text-muted">
            <i class="bi bi-rocket-takeoff" style="font-size:48px;color:#4f8ef7;"></i>
            <h5 class="mt-3" style="color:#1a2744;">JojoJobel EduSaaS est prêt</h5>
            <p class="mb-0">Commencez par créer l'année scolaire, puis les classes et les élèves.</p>
        </div>
    </div>
</div>

@endsection