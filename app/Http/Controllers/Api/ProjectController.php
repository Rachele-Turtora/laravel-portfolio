<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('type')->paginate(3);

        return response()->json([
            "success" => true,
            "results" => $projects
        ]);
    }

    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)->with('type', 'user', 'technologies')->first();

        if ($project) {
            return response()->json([
                "success" => true,
                "results" => $project
            ]);
        } else {
            return response()->json([
                "success" => false,
                "results" => null
            ], 404);
        }
    }
}
