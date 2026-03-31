<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Routes à venir — on les active au fur et à mesure
    Route::get('/eleves',      fn() => view('coming-soon', ['module' => 'Élèves']))->name('eleves.index');
    Route::get('/inscriptions',fn() => view('coming-soon', ['module' => 'Inscriptions']))->name('inscriptions.index');
    Route::get('/notes',       fn() => view('coming-soon', ['module' => 'Notes & Bulletins']))->name('notes.index');
    Route::get('/enseignants', fn() => view('coming-soon', ['module' => 'Enseignants']))->name('enseignants.index');
    Route::get('/classes',     fn() => view('coming-soon', ['module' => 'Classes']))->name('classes.index');
    Route::get('/paiements',   fn() => view('coming-soon', ['module' => 'Scolarité']))->name('paiements.index');
    Route::get('/discipline',  fn() => view('coming-soon', ['module' => 'Discipline']))->name('discipline.index');
});

require __DIR__.'/auth.php';