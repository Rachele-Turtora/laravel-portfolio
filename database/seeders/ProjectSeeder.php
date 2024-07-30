<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = config('projects');

        foreach ($projects as $project_db) {
            $project = new Project();

            $project->title = $project_db['title'];
            $project->description = $project_db['description'];
            $project->slug = Str::of($project->title)->slug('-');

            $project->save();
        }
    }
}
