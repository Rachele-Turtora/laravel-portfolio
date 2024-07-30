<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // per vedere solo i progetti dell'utente loggato:
        // $projects = Project::where('user_id', Auth::user()->id)->get();

        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        //$img_path = $request->hasFile('cover_img') ? Storage::put('uploads', $data['cover_img']) : NULL;
        $img_path = $request->hasFile('cover_img') ? $request->cover_img->store('uploads') : NULL;

        $project = new Project();

        $project->title = $data['title'];
        $project->description = $data['description'];
        $project->slug = Str::of($project->title)->slug('-');
        $project->cover_img = $img_path;
        $project->type_id = $data['type_id'];
        $project->user_id = Auth::user()->id;

        $project->save();

        //$project->fill($data);
        //$prject->save();

        // se esistono tecnologie nella richiesta creo la relazione nella tabella pivot
        if ($request->has('technologies')) {
            // attacco le tecnologie alla tabella pivot
            $project->technologies()->attach($request->technologies);
        }

        return redirect()->route('admin.projects.show', $project->slug)->with('message', 'Progetto creato con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        $data['slug'] = Str::of($project->title)->slug('-');

        $img_path = $request->hasFile('cover_img') ? $request->cover_img->store('uploads') : NULL;
        $data['cover_img'] = $img_path;

        $project->update($data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        } else {
            $project->technologies()->detach();
        }
        // versione abbreviata:
        // $project->technologies()->sync('$request->technologies');

        return redirect()->route('admin.projects.show', $project->slug)->with('message', 'Progetto modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // cancello la relazione a prescindere dalla configurazione del DB 
        // (ho messo cascadeOnDelete quindi laravel lo farebbe per me in questo caso)
        $project->technologies()->detach();

        if ($project->cover_img) {
            Storage::delete($project->cover_img);
        }

        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', 'Progetto eliminato con successo');
    }
}
