<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {

        $searchTitle = $request->input('title');

        $query = Project::with('type')->where('status', 'in evidenza');

        if ($searchTitle) {
            $query->where('title', 'like', '%' . $searchTitle . '%');
        }

        $projects = $query->paginate(3);

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
