<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Application' => 'App\Policies\ApplicationPolicy',
        'App\Models\Area' => 'App\Policies\AreaPolicy',
        'App\Models\CompanyAddress' => 'App\Policies\CompanyAddressPolicy',
        'App\Models\Company' => 'App\Policies\CompanyPolicy',
        'App\Models\CompanyPerson' => 'App\Policies\CompanyPersonPolicy',
        'App\Models\Coordinator' => 'App\Policies\CoordinatorPolicy',
        'App\Models\Course' => 'App\Policies\CoursePolicy',
        'App\Models\EndedInternship' => 'App\Policies\EndedInternshipPolicy',
        'App\Models\StartedInternship' => 'App\Policies\StartedInternshipPolicy',
        'App\Models\StudentCollection' => 'App\Policies\StudentCollectionPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
