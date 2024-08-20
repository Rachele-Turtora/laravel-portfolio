<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status');

        $projects = Project::query();

        if ($status) {
            $projects->where('status', $status);
        }

        $projects = $projects->get();

        return view('admin.dashboard', compact('projects'));
    }
}
