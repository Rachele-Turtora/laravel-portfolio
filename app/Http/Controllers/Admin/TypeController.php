<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();

        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $data = $request->validated();

        $img_path = $request->hasFile('cover_img') ? $request->cover_img->store('uploads') : NULL;

        $type = new Type();
        $type->title = $data['title'];
        $type->slug = Str::of($type->title)->slug('-');
        $type->description = $data['description'];
        $type->cover_img = $img_path;

        $type->save();

        return redirect()->route('admin.types.show', $type->slug)->with('message', 'Tipo creato con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $data = $request->validated();

        $data['slug'] = Str::of($type->title)->slug('-');

        $img_path = $request->hasFile('cover_img') ? $request->cover_img->store('uploads') : NULL;
        $data['cover_img'] = $img_path;

        $type->update($data);

        return redirect()->route('admin.types.show', $type->slug)->with('message', 'Tipo aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        if ($type->cover_img) {
            Storage::delete($type->cover_img);
        }

        $type->delete();

        return redirect()->route('admin.types.index')->with('message', 'Tipo eliminato con successo');
    }
}
