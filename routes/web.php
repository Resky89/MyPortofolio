<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutMeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;

// Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/about', [AboutMeController::class, 'index'])->name('about');
// Route::get('/projects', [ProjectController::class, 'index'])->name('projects');

Route::get('/', [HomeController::class, 'index']);

Route::get('/about', [AboutMeController::class, 'index'])->name('about');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('project.show');
Route::post('/projects', [ProjectController::class, 'store'])->name('project.store');
Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('project.update');
Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');

Route::get('/project-detail', function () {
    return view('project-detail');
});
