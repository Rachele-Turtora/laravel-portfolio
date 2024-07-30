@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="m-3">Lista dei progetti</h2>

    <ul>
        @foreach ($projects as $project)
        <li class="m-2">
            <div class="w-75">
                <div class="d-flex justify-content-between align-items-center mb-1 mt-3">
                    <div>
                        <a href="{{route('admin.projects.show', $project)}}">
                            <span class="title"><strong>{{$project['title']}}</strong></span>
                        </a>
                    </div>
                    <div class="d-flex">
                        <a href="{{route('admin.projects.edit', $project)}}">
                            <button class="btn btn-outline-primary ms-4">
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                        </a>
                        <button class="btn btn-outline-danger ms-3 delete-button">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
                <hr>
            </div>
        </li>
        @endforeach
        @include('partials.modal')
    </ul>

    <a href="{{route('admin.projects.create')}}">
        <button class="btn btn-outline-secondary mx-3">Inserisci nuovo progetto</button>
    </a>
</div>
@endsection