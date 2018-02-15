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
        \App\User::class => \App\Policies\UserPolicy::class,
        \App\Medication::class => \App\Policies\MedicationPolicy::class,
        \App\Order::class => \App\Policies\OrderPolicy::class,
        \App\Lab::class => \App\Policies\LabPolicy::class,
        \App\Patient::class => \App\Policies\PatientPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
