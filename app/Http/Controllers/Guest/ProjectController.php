<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('id', '<=', '5')->get();

        return view('guests.projects.index', compact('projects'));
    }

    public function show()
    {
    }
}
