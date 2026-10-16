<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployeController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\ProduitsController;
use App\Http\Controllers\Api\VenteControllers;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\StatistiqueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login-boutiquier', [AuthController::class, 'login']);
Route::post('/login-employe', [AuthController::class, 'loginEmploye']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/categories', [MainController::class, 'getCategories']);
    Route::post('/boutiques/logo', [MainController::class, 'updateLogo']);
    Route::post('/ventes', [VenteControllers::class, 'store']);
    Route::get('/ventes/recentes', [VenteControllers::class, 'ventesRecentes']);

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::post('/auth/change-pin', [AuthController::class, 'changePin']);
    Route::post('/produits', [ProduitsController::class, 'storeProduits']);
    Route::get('/boutiques/{boutiqueId}/produits', [ProduitsController::class, 'index']);
    Route::post('/produits/{produitId}/update', [ProduitsController::class, 'update']);
    Route::delete('/produits/{produit}', [ProduitsController::class, 'destroy']);
    Route::post('/produits/{produitId}/entree-stock', [ProduitsController::class, 'entreeStock']);
    Route::get('/ventes', [VenteControllers::class, 'index']);
    Route::get('/statistiques', [StatistiqueController::class, 'index']);
    Route::get('/depenses', [DepenseController::class, 'index']);
    Route::post('/depenses', [DepenseController::class, 'store']);
    Route::get('/boutiques/{boutiqueId}/employes', [EmployeController::class, 'index']);
    Route::post('/employes', [EmployeController::class, 'store']);
    Route::post('/employes/{id}/toggle-actif', [EmployeController::class, 'toggleActif']);
    Route::post('/employes/{id}/permissions', [EmployeController::class, 'updatePermissions']);
});
