<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        $project = new Project();

        $project->title = $data['title'];
        $project->description = $data['description'];
        $project->slug = Str::of($project->title)->slug('-');
        $project->type_id = $data['type_id'];
        $project->status = $data['status'];

        $project->save();

        if ($request->has('technologies')) {
            $project->technologies()->attach($request->technologies);
        }
    }
}
