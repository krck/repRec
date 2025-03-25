<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class AdminSelectionController extends Controller
{
    /**
     * GET all error logs with their assigned users
     * (Admin only)
     */
    public function index(Request $request): View
    {
        // Selection options (hardcoded for now)
        $selections = [
            [
                "name" => "Exercise Categories",
                "comment" => "Basic categories, defining exercise templates and grouping",
                "link" => "/exercise-category"
            ],
            [
                "name" => "Exercises",
                "comment" => "Exercise data, including all relevant information",
                "link" => "/exercise"
            ],
        ];

        return view('admin-selections', data: ['selections' => $selections]);
    }
}
