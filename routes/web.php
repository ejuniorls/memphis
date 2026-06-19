<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

// Rota check-email — exibida após envio do link de reset de senha
Route::get('/check-email', fn() => session()->has('email')
    ? view('pages::auth.check-email')
    : redirect()->route('password.request')
)->name('auth.check-email');

// Sobrescreve o POST do Fortify para redirecionar ao check-email
Route::post('/forgot-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

// Rota password-changed — exibida após reset de senha bem-sucedido
Route::get('/password-changed', fn() => view('pages::auth.password-changed'))->name('auth.password-changed');

// Sobrescreve o POST do Fortify de reset para redirecionar ao password-changed
Route::post('/reset-password', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

// Sobrescreve o redirect do Fortify após verificação de e-mail
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('dashboard')->with('just_verified', true);
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::group(['prefix' => 'ui', 'as' => 'pages::ui.'], function () {
    Route::livewire('/',            'pages::ui-showcase')->name('showcase');
    Route::livewire('/accordion',   'pages::ui.accordion')->name('accordion');
    Route::livewire('/alert',       'pages::ui.alert')->name('alert');
    Route::livewire('/badge',       'pages::ui.badge')->name('badge');
    Route::livewire('/breadcrumb',  'pages::ui.breadcrumb')->name('breadcrumb');
    Route::livewire('/button',      'pages::ui.button')->name('button');
    Route::livewire('/card',        'pages::ui.card')->name('card');
    Route::livewire('/checkbox',    'pages::ui.checkbox')->name('checkbox');
    Route::livewire('/input',       'pages::ui.input')->name('input');
    Route::livewire('/link',        'pages::ui.link')->name('link');
    Route::livewire('/modal',       'pages::ui.modal')->name('modal');
    Route::livewire('/pagination',  'pages::ui.pagination')->name('pagination');
    Route::livewire('/select',      'pages::ui.select')->name('select');
    Route::livewire('/stepper',     'pages::ui.stepper')->name('stepper');
    Route::livewire('/toast',       'pages::ui.toast')->name('toast');
});

Route::livewire('/stepper-wizard', 'pages::ui.stepper-wizard')->name('stepper-wizard');


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

        Route::livewire('/layout', 'pages::settings.layout')->name('layout');

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

    // ------------------------------------------------------------------
    // Fundepag
    // ------------------------------------------------------------------
    Route::prefix('fundepag')->name('fundepag.')->group(function () {
        Route::livewire('/institutos', 'pages::fundepag.institutes.index')->name('institutes.index');
        Route::livewire('/centros',    'pages::fundepag.centers.index')->name('centers.index');
        Route::livewire('/contratos',  'pages::fundepag.contracts.index')->name('contracts.index');
    });

});
