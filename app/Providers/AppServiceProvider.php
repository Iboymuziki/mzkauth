<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Session;

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
         //Redirect an Authenticated User to dashboard
        RedirectIfAuthenticated::redirectUsing(function(){
            return route('admin.dashboard');
        });

        //Redirect No Authenticated User to Admin Login Page
        Authenticate::redirectUsing(function(){
            Session::flash('fail','Vous devez être connecté pour accéder à la partie admin.');
            return route('admin.login');
        });
    }
}
