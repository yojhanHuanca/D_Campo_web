<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('perfil.sidebar', function ($view) {

            $totalPedidos = 0;

            if (Auth::check()) {
                $totalPedidos = Pedido::where('user_id', Auth::id())->count();
            }

            $view->with('totalPedidos', $totalPedidos);
        });
    }
}
