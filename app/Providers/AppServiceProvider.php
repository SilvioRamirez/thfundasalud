<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

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
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
        
        Paginator::useBootstrapFive(); /* Usasr Bootstrap 5 */

        // Compartir el ID del usuario autenticado con la vista del menú
        View::composer('vendor.adminlte.partials.sidebar.menu-item', function ($view) {
            $view->with('userCedula', auth()->cedula()); // Pasa el ID del usuario autenticado
        });
    }
}
