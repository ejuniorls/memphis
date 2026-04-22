<?php

namespace App\Providers;

use App\View\Composers\SidebarMenuComposer;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
        $this->registerViewComposers();
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn(): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }

    /**
     * Registra os View Composers da aplicação.
     * O SidebarMenuComposer injeta $menuTree em todos os partials de sidebar de cada layout.
     */
    protected function registerViewComposers(): void
    {
        View::composer([
            // dark-sidebar
            'layouts.admin.dark-sidebar.partials.sidebar-menu',

            // multiple-menus
            'layouts.admin.multiple-menus.partials.sidebar-menu',

            // dropdown-menu
            'layouts.admin.dropdown-menu.partials.sidebar-menu',

            // compact-sidebar
            'layouts.admin.compact-sidebar.sidebar',
            'layouts.admin.compact-sidebar.partials.navbar-menu',

            // horizontal-menu
            'layouts.admin.horizontal-menu.partials.navbar-menu',

            // two-column-sidebar (menu inline no próprio sidebar.blade.php)
            'layouts.admin.two-column-sidebar.sidebar',
        ], SidebarMenuComposer::class);
    }
}
