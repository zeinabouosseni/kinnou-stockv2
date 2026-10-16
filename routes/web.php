<?php

use App\Livewire\Pages\Auth\Login;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', Login::class)
    ->name('login');

require __DIR__ . '/admin.php';
