<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;


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
    public function boot()
    {
        $this->registerGate();
    }
    
    protected function registerGate()
    {
        Gate::define('admin', function ($user) {
            return $user->user_type === 'admin';
        });
    
        Gate::define('user', function ($user) {
            return $user->user_type === 'user';
        });
    
        Gate::define('moderator', function ($user) {
            return $user->user_type === 'moderator';
        });

        // Agregamos la puerta para 'edit-roles'
        Gate::define('edit-roles', function ($user) {
            return $user->user_type === 'admin'; // Permite a los administradores editar roles
        });

    }

    


























 
    
}
