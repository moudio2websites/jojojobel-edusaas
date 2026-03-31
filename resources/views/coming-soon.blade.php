@extends('layouts.admin')
@section('title', $module)
@section('page-title', $module)
@section('content')
<div class="card border-0 shadow-sm p-5 text-center text-muted">
    <i class="bi bi-tools" style="font-size:48px;color:#f0a623;"></i>
    <h5 class="mt-3" style="color:#1a2744;">Module {{ $module }}</h5>
    <p>Ce module est en cours de développement. Revenez bientôt !</p>
</div>
@endsection