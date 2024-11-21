<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();

        Gate::define('logado', function ($user) {
            return true;
        });

        Gate::define('biblioteca', function ($user) {
            if(Gate::allows('admin')) return true;
            $biblioteca = explode(',', trim(env('CODPES_BIBLIOTECA')));
            return in_array($user->codpes,$biblioteca);
        });

        Gate::define('comunicacao', function ($user) {
            if(Gate::allows('admin')) return true;
            $comunicacao = explode(',', trim(env('CODPES_COMUNICACAO')));
            return in_array($user->codpes,$comunicacao);
        });

    }
}
