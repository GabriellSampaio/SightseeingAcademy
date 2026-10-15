<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Adm\DashboardController;
use App\Http\Controllers\Adm\SchoolController;
use App\Http\Controllers\Adm\ProjectController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::prefix('adm/escolas')->name('adm.schools.')->group(function () {
    Route::get('/', [SchoolController::class, 'index'])->name('index');
    Route::get('/cadastrar', [SchoolController::class, 'create'])->name('create');
    Route::post('/salvar', [SchoolController::class, 'store'])->name('store');
    Route::get('/{school}/editar', [SchoolController::class, 'edit'])->name('edit');
    Route::put('/{school}/atualizar', [SchoolController::class, 'update'])->name('update');
});

use App\Http\Controllers\Adm\TouristPointController;

Route::prefix('adm/pontos-turisticos')->name('Adm.tourist_points.')->group(function () {
    Route::get('/', [TouristPointController::class, 'index'])->name('index');          // Listagem
    Route::get('/criar', [TouristPointController::class, 'create'])->name('create');    // Form Criar
    Route::post('/salvar', [TouristPointController::class, 'store'])->name('store');     // Salvar Criar
    Route::get('/{point}/editar', [TouristPointController::class, 'edit'])->name('edit'); // Form Editar
    Route::put('/{point}/atualizar', [TouristPointController::class, 'update'])->name('update'); // Salvar Editar
    Route::delete('/{point}/excluir', [TouristPointController::class, 'destroy'])->name('destroy'); // Deletar
});

// Rota inicial - Direciona para o método 'index' do DashboardController
Route::get('/', [DashboardController::class, 'index'])->name('Adm.dashboard');

// Rotas para Escolas
Route::get('/adm/escolas/cadastrar', [SchoolController::class, 'create'])->name('adm.schools.create');
Route::post('/adm/escolas/salvar', [SchoolController::class, 'store'])->name('adm.schools.store');

// Rotas para Projetos
Route::get('/adm/projetos/criar', [ProjectController::class, 'create'])->name('adm.projects.create');
Route::post('/adm/projetos/salvar', [ProjectController::class, 'store'])->name('adm.projects.store');