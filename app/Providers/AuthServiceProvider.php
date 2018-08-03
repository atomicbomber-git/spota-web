<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('active',function($user){
            return $user->status === "A";
        });

        Gate::define('admin',function($user){
            return $user->type === "A" ;
        });

        Gate::define('student',function($user){
            return $user->type === "M" ;
        });

        Gate::define('lecturer',function($user){
            return $user->type === "D" ;
        });

        Gate::define('manage-superadmin',function($user){
            return $user->admin->privileges === "S";
        });

        Gate::define('manage-admin',function($user){
            return $user->admin->privileges === "P";
        });

        Gate::define('manage-student','App\Policies\StudentPolicy@handle');
        Gate::define('manage-lecturer','App\Policies\LecturerPolicy@handle');

    }
}
