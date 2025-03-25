<?php

namespace App\Providers;

use App\Common\Enums\EnumRole;
use App\Services\UserRoleService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Global UserService to store/retrieve user-roles
        $this->app->singleton(UserRoleService::class, function () {
            return new UserRoleService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*
         * Global GATEs for Role-based Authorization
         * 
         * Can be used in Blade templates (to show/hide elements):
         * @can('isAdmin') ... @endcan
         * 
         * Can be used in Controllers (to allow/deny access):
         * Gate::authorize('isAdmin');
         */
        Gate::define('isAdmin', function ($user) {
            $userService = app(UserRoleService::class);
            $userRolesHash = $userService->getUserRoles($user->id);
            return (
                !empty($userRolesHash)
                && array_key_exists(EnumRole::Admin->value, $userRolesHash)
                && ($userRolesHash[EnumRole::Admin->value] == true)
            );
        });
        Gate::define('isPlanner', function ($user) {
            $userService = app(UserRoleService::class);
            $userRolesHash = $userService->getUserRoles($user->id);
            return (
                !empty($userRolesHash)
                && array_key_exists(EnumRole::Planner->value, $userRolesHash)
                && ($userRolesHash[EnumRole::Planner->value] == true)
            );
        });
        Gate::define('isUser', function ($user) {
            $userService = app(UserRoleService::class);
            $userRolesHash = $userService->getUserRoles($user->id);
            return (
                !empty($userRolesHash)
                && array_key_exists(EnumRole::User->value, $userRolesHash)
                && ($userRolesHash[EnumRole::User->value] == true)
            );
        });
    }
}
