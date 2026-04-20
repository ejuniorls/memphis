<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::livewire('/dashboard', 'pages::dashboard')->name('dashboard');

    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::redirect('/', 'settings/profile');

        Route::livewire('/profile', 'pages::settings.profile')->name('profile');

        Route::livewire('/  ', 'pages::settings.appearance')->name('appearance');
        
        Route::livewire('/security', 'pages::settings.security')->name('security');
    });
});

require __DIR__.'/settings.php';
