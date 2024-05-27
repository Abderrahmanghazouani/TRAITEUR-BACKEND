<?php


use App\Http\Controllers\AnnonceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DemandeController;

Route::middleware('api')->group(function () {
    Route::get('/clients', [ClientController::class, 'index']);
    Route::post('/clients', [ClientController::class, 'store']);
    Route::delete('/clients/{id}', [ClientController::class, 'destroy']);

    Route::get('/demandes', [DemandeController::class, 'index']);
    Route::post('/demandes', [DemandeController::class, 'store']);
    Route::delete('/demandes/{id}', [DemandeController::class, 'destroy']);

});

Route::get('annonces', [AnnonceController::class, 'index']);
Route::get('annonces/{id}', [AnnonceController::class, 'show']);
Route::post('annonces', [AnnonceController::class, 'store']);
Route::put('annonceupdate/{id}', [AnnonceController::class, 'update']);
Route::delete('annoncedelete/{id}', [AnnonceController::class, 'destroy']);

