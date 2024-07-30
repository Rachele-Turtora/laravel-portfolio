@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mx-2 my-3">I tuoi progetti</h2>

    <div class="row d-flex flex-wrap">
        @foreach ($projects as $project)
        <div class="col-lg-4 col-sm-6">
            <a href="{{route('admin.projects.show', $project)}}">
                <div class="card p-3 m-2">
                    <div class="dash-img-container">
                        <img src="{{asset('storage/' . $project->cover_img)}}" alt="">
                    </div>
                    <h4>{{$project->title}}</h4>
                    <p>{{$project->description}}</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection