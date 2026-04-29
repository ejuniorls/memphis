<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

// Sobrescreve o redirect do Fortify após verificação de e-mail
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('dashboard')->with('just_verified', true);
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::middleware(['auth', 'verified'])->group(function () {

    // ------------------------------------------------------------------
    // Dashboard
    // ------------------------------------------------------------------
    Route::livewire('/dashboard', 'pages::dashboard')->name('dashboard');

    // ------------------------------------------------------------------
    // Account (configurações pessoais do usuário logado)
    // ------------------------------------------------------------------
    Route::prefix('account')->name('account.')->group(function () {
        Route::redirect('/', 'account/profile');

        Route::livewire('/profile', 'pages::account.profile')->name('profile');
        Route::livewire('/security', 'pages::account.security')->name('security');
        Route::livewire('/appearance', 'pages::account.appearance')->name('appearance');
        Route::livewire('/notifications', 'pages::account.notifications')->name('notifications');
    });

    // ------------------------------------------------------------------
    // Settings (configurações globais da aplicação — TI / super admin)
    // ------------------------------------------------------------------
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::redirect('/', 'settings/company');

        // Empresa
        Route::prefix('company')->name('company.')->group(function () {
            Route::livewire('/', 'pages::settings.company.index')->name('index');
            Route::livewire('/fiscal', 'pages::settings.company.fiscal')->name('fiscal');
            Route::livewire('/contact', 'pages::settings.company.contact')->name('contact');
        });

        // Usuários & Permissões
        Route::prefix('users')->name('users.')->group(function () {
            Route::livewire('/', 'pages::settings.users.index')->name('index');
            Route::livewire('/create', 'pages::settings.users.create')->name('create');
            Route::livewire('/{user}/edit', 'pages::settings.users.edit')->name('edit');
            Route::livewire('/invite', 'pages::settings.users.invite')->name('invite');
        });

        Route::prefix('roles')->name('roles.')->group(function () {
            Route::livewire('/', 'pages::settings.roles.index')->name('index');
            Route::livewire('/create', 'pages::settings.roles.create')->name('create');
            Route::livewire('/{role}/edit', 'pages::settings.roles.edit')->name('edit');
        });

        // Menus
        Route::prefix('menus')->name('menus.')->group(function () {
            Route::livewire('/', 'pages::settings.menus.index')->name('index');
            Route::livewire('/create', 'pages::settings.menus.create')->name('create');
            Route::livewire('/{menu}/edit', 'pages::settings.menus.edit')->name('edit');
        });

        // Integrações
        Route::prefix('integrations')->name('integrations.')->group(function () {
            Route::livewire('/', 'pages::settings.integrations.index')->name('index');
            Route::livewire('/create', 'pages::settings.integrations.create')->name('create');
            Route::livewire('/{integration}/edit', 'pages::settings.integrations.edit')->name('edit');
        });

        // Sistema
        Route::prefix('system')->name('system.')->group(function () {
            Route::livewire('/params', 'pages::settings.system.params')->name('params');
            Route::livewire('/backup', 'pages::settings.system.backup')->name('backup');
            Route::livewire('/audit-log', 'pages::settings.system.audit-log')->name('audit-log');
        });
    });
});
