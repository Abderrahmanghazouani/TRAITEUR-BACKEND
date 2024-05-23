<?php

use App\Http\Controllers\AnnonceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('annonces', [AnnonceController::class, 'index']);
Route::get('annonces/{id}', [AnnonceController::class, 'show']);
Route::post('annonces', [AnnonceController::class, 'store']);
Route::put('annonceupdate/{id}', [AnnonceController::class, 'update']);
Route::delete('annoncedelete/{id}', [AnnonceController::class, 'destroy']);
