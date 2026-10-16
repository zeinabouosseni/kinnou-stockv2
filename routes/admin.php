<?php

use App\Livewire\Pages\Admin\AbonnementListing;
use App\Livewire\Pages\Admin\Dashboard;
use App\Livewire\Pages\Admin\ListingBoutiques;
use App\Livewire\Pages\Admin\StatistiquesManager;
use App\Livewire\Pages\Admin\UtilisateursListing;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('/admin')->name("admin.")->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('dashboard');
        Route::get('/boutiques', ListingBoutiques::class)->name('boutiques');
        Route::get('/abonnements', AbonnementListing::class)->name('abonnements');
        Route::get('/utilisateurs', UtilisateursListing::class)->name('utilisateurs');
        Route::get('/statistiques', StatistiquesManager::class)->name('statistiques');
    });
});
