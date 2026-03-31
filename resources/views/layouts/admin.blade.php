<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'JojoJobel EduSaaS')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

{{-- ═══ SIDEBAR ═══ --}}
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="app-name">
            <i class="bi bi-mortarboard-fill me-1" style="color:#4f8ef7;"></i>
            JojoJobel
        </div>
        <div class="tenant-name">
            {{ auth()->user()->tenant?->nom_ecole ?? 'Administration centrale' }}
        </div>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-section-label">Principal</div>
        <a href="{{ route('dashboard') }}"
           class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i> Tableau de bord
        </a>
        <a href="{{ route('eleves.index') }}"
           class="sidebar-link {{ request()->routeIs('eleves.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Élèves
        </a>
        <a href="{{ route('inscriptions.index') }}"
           class="sidebar-link {{ request()->routeIs('inscriptions.*') ? 'active' : '' }}">
            <i class="bi bi-person-plus"></i> Inscriptions
        </a>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-section-label">Pédagogie</div>
        <a href="{{ route('notes.index') }}"
           class="sidebar-link {{ request()->routeIs('notes.*') ? 'active' : '' }}">
            <i class="bi bi-journal-check"></i> Notes & bulletins
        </a>
        <a href="{{ route('enseignants.index') }}"
           class="sidebar-link {{ request()->routeIs('enseignants.*') ? 'active' : '' }}">
            <i class="bi bi-person-badge"></i> Enseignants
        </a>
        <a href="{{ route('classes.index') }}"
           class="sidebar-link {{ request()->routeIs('classes.*') ? 'active' : '' }}">
            <i class="bi bi-building"></i> Classes
        </a>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-section-label">Gestion</div>
        <a href="{{ route('paiements.index') }}"
           class="sidebar-link {{ request()->routeIs('paiements.*') ? 'active' : '' }}">
            <i class="bi bi-cash-coin"></i> Scolarité
        </a>
        <a href="{{ route('discipline.index') }}"
           class="sidebar-link {{ request()->routeIs('discipline.*') ? 'active' : '' }}">
            <i class="bi bi-exclamation-triangle"></i> Discipline
        </a>
        <a href="#"
           class="sidebar-link {{ request()->routeIs('documents.*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text"></i> Documents
        </a>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-section-label">Compte</div>
        <a href="#" class="sidebar-link">
            <i class="bi bi-gear"></i> Paramètres
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-link w-100 border-0 bg-transparent text-start">
                <i class="bi bi-box-arrow-left"></i> Déconnexion
            </button>
        </form>
    </div>
</aside>

{{-- ═══ MAIN ═══ --}}
<div class="main-wrapper">

    {{-- Topbar --}}
    <header class="topbar">
        <span class="topbar-title">@yield('page-title', 'Tableau de bord')</span>
        <div class="d-flex align-items-center gap-3">
            @if(session('annee_active'))
                <span class="badge" style="background:#e8f0fe;color:#1a2744;font-weight:500;">
                    {{ session('annee_active') }}
                </span>
            @endif
            <span style="font-size:13px;color:#8a93a6;">
                <i class="bi bi-person-circle me-1"></i>
                {{ auth()->user()->name }}
            </span>
        </div>
    </header>

    {{-- Contenu principal --}}
    <main class="content-area">

        {{-- Alertes flash --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                <i class="bi bi-x-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

</div>
</body>
</html>