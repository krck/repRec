<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class UserRoleController extends Controller
{
    /**
     * GET all users with their assigned roles
     * (Admin only)
     */
    public function index(Request $request): View
    {
        // Get all user data with their roles (users, roles, user_roles)
        $userRoles = User::select('users.id', 'users.name', 'users.email', 'users.email_verified_at', 'roles.name as role')
            ->leftJoin('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->leftJoin('roles', 'roles.id', '=', 'user_roles.role_id')
            ->orderByDesc('users.name')
            ->paginate(10);

        // Return only incudes specific columns of the paginated result
        return view('admin-userroles', data: ['userRoles' => $userRoles]);
    }
}
