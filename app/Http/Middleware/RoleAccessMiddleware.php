<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Services\UserRoleService;
use App\Common\Enums\EnumRole;
use Illuminate\Http\Request;
use Exception;
use Closure;

class RoleAccessMiddleware
{
    /**
     * Authorization: Check if user has the specified roles to access the endpoint
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $authUserId = null;
        try {
            // Load user roles (from cache or db) and verify that at least one matches the filter
            $authUserId = Auth::user()->id;
            $userService = app(UserRoleService::class);
            $userRolesHash = $userService->getUserRoles($authUserId);
            if (empty($userRolesHash)) {
                throw new Exception("No roles found for user");
            }

            // Check all roles (Ensure $roles is always an array)
            $roles = is_array($roles) ? $roles : [$roles];
            foreach ($roles as $role) {
                if (
                    (strtolower($role) == "admin" && $userRolesHash[EnumRole::Admin->value] == true)
                    || (strtolower($role) == "planner" && $userRolesHash[EnumRole::Planner->value] == true)
                    || (strtolower($role) == "user" && $userRolesHash[EnumRole::User->value] == true)
                ) {
                    return $next($request);
                }
            }

            // If none matches, deny further execution (no next)
            throw new Exception("No valid role");
        } catch (\Throwable $th) {
            // Middleware Exceptions: Log immediately and abort/fail with a "clean" response
            $userStr = ($authUserId != null ? " User - $authUserId " : "");
            Log::error("RoleAccessMiddleware: " . $userStr . $th->getMessage());
            abort(Response::HTTP_FORBIDDEN);
        }
    }
}
