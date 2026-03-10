<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\FieldController;
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
    /* PRODUTOS */
    Route::get("/produtos", [ProductController::class, "index"])->name("products.index");
    Route::get("/produtos/novo", [ProductController::class, "create"])->name("products.create");
    Route::post("/produtos/novo", [ProductController::class, "store"])->name("products.store");
    Route::get("/produtos/{id}", [ProductController::class, "edit"])->name("products.edit");
    Route::put("/produtos/{id}", [ProductController::class, "update"])->name("products.update");
    Route::delete("/produtos/{id}", [ProductController::class, "destroy"])->name("products.destroy");

    /* FAZENDAS */
    Route::get("/fazendas", [FarmController::class, "index"])->name("farms.index");
    Route::get("/fazendas/novo", [FarmController::class, "create"])->name("farms.create");
    Route::post("/fazendas/novo", [FarmController::class, "store"])->name("farms.store");
    Route::get("/fazendas/{id}", [FarmController::class, "edit"])->name("farms.edit");
    Route::put("/fazendas/{id}", [FarmController::class, "update"])->name("farms.update");
    Route::delete("/fazendas/{id}", [FarmController::class, "destroy"])->name("farms.destroy");

    /* TALHÕES */
    Route::get("/talhoes", [FieldController::class, "index"])->name("fields.index");
    Route::get("/talhoes/novo", [FieldController::class, "create"])->name("fields.create");
    Route::post("/talhoes/novo", [FieldController::class, "store"])->name("fields.store");
    Route::get("/talhoes/{id}", [FieldController::class, "edit"])->name("fields.edit");
    Route::put("/talhoes/{id}", [FieldController::class, "update"])->name("fields.update");
    Route::delete("/talhoes/{id}", [FieldController::class, "destroy"])->name("fields.destroy");

    /* Rotas do Perfil de Usuário */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
