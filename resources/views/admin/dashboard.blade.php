@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="mx-2 my-3">I tuoi progetti</h2>
        <form method="GET" action="{{route('admin.dashboard')}}">
            <select class="form-select w-50 h-75" name="status" onchange="this.form.submit()">
                <option value="" {{request('status') == '' ? 'selected' : ''}}>Tutti</option>
                <option value="in draft" {{request('status') == 'in draft' ? 'selected' : ''}}>In draft</option>
                <option value="in evidenza" {{request('status') == 'in evidenza' ? 'selected' : ''}}>In evidenza</option>
            </select>
        </form>
    </div>

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
                    <div class="rounded w-50 p-2 text-center
                        {{$project->status == 'in draft' ? 'bg-warning-subtle' : 'bg-success-subtle'}}">
                        {{$project->status}}
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection