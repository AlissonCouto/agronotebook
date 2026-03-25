<?php

use App\Http\Controllers\CropController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\ApplicationController;
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
    Route::get("/fazendas/{id}/usuarios", [FarmController::class, "users"])->name("farms.users");
    Route::get("/fazendas/{id}/usuarios/novo", [FarmController::class, "createUser"])->name("farms.users.create");
    Route::post('/fazendas/{id}/usuarios/novo', [FarmController::class, 'storeUser'])
        ->name('farms.users.store');
    Route::get('/farms/{farm}/users/{user}/edit', [FarmController::class, 'editUser'])
        ->name('farms.users.edit');
    Route::put('/farms/{farm}/users/{user}', [FarmController::class, 'updateUser'])
        ->name('farms.users.update');
    Route::delete('/farms/{farm}/users/{user}', [FarmController::class, 'destroyUser'])
        ->name('farms.users.destroy');

    /* TALHÕES */
    Route::get("/talhoes", [FieldController::class, "index"])->name("fields.index");
    Route::get("/talhoes/novo", [FieldController::class, "create"])->name("fields.create");
    Route::post("/talhoes/novo", [FieldController::class, "store"])->name("fields.store");
    Route::get("/talhoes/{id}", [FieldController::class, "edit"])->name("fields.edit");
    Route::put("/talhoes/{id}", [FieldController::class, "update"])->name("fields.update");
    Route::delete("/talhoes/{id}", [FieldController::class, "destroy"])->name("fields.destroy");

    /* CULTURAS */
    Route::get("/culturas", [CropController::class, "index"])->name("crops.index");
    Route::get("/culturas/novo", [CropController::class, "create"])->name("crops.create");
    Route::post("/culturas/novo", [CropController::class, "store"])->name("crops.store");
    Route::get("/culturas/{id}", [CropController::class, "edit"])->name("crops.edit");
    Route::put("/culturas/{id}", [CropController::class, "update"])->name("crops.update");
    Route::delete("/culturas/{id}", [CropController::class, "destroy"])->name("crops.destroy");

    /* APLICAÇÕES */

    Route::get("/aplicacoes", [ApplicationController::class, "index"])
        ->name("applications.index");

    Route::get("/aplicacoes/novo", [ApplicationController::class, "create"])
        ->name("applications.create");

    Route::post("/aplicacoes/novo", [ApplicationController::class, "store"])
        ->name("applications.store");

    Route::get("/aplicacoes/{id}", [ApplicationController::class, "edit"])
        ->name("applications.edit");

    Route::put("/aplicacoes/{id}", [ApplicationController::class, "update"])
        ->name("applications.update");

    Route::delete("/aplicacoes/{id}", [ApplicationController::class, "destroy"])
        ->name("applications.destroy");

    /* Rotas do Perfil de Usuário */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
