<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Se tiver policies de models, registre aqui depois
        // Example: 'App\Models\Book' => 'App\Policies\BookPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        Gate::define('manage-users', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-library', function ($user) {
            return in_array($user->role, ['admin', 'bibliotecario']);
        });

        Gate::define('view-only', function ($user) {
            return in_array($user->role, ['admin', 'bibliotecario', 'cliente']);
        });


        Gate::before(function ($user, $ability) {
            if ($user->role === 'admin') {
                return true;
            }
        });

        Gate::define('isAdmin', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-borrowings', function ($user) {
            return in_array($user->role, ['admin', 'bibliotecario']);
        });
    }
}
