<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    /* Rotas dos módulos do admin */
    Route::get("/produtos", [ProductController::class, "index"])->name("products.index");
    Route::get("/produtos/novo", [ProductController::class, "create"])->name("products.create");
    Route::post("/produtos/novo", [ProductController::class, "store"])->name("products.store");

    /* Rotas do Perfil de Usuário */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
