@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('message'))
    <div class="alert alert-success m-2">
        {{ session('message') }}
    </div>
    @endif

    <div class="m-3">
        <div class="d-flex justify-content-between">
            <h2>{{$project['title']}}</h2>
            <div class="rounded bg-warning-subtle p-3 w-25 text-center">
                {{$project['status']}}
            </div>
        </div>
        <p><strong>Creato da: </strong>{{$project->user?->name ?: "Utente sconosciuto"}}</p>
        <div class="img-container mb-2">
            @if ($project->cover_img)
            <img src="{{asset('storage/' . $project->cover_img)}}" alt="">
            @endif
        </div>
        <p><strong>Tipo: </strong>{{$project->type?->title ?: "Undefined"}}</p>
        <p><strong>Tecnologie utilizzate: </strong></p>
        <ul>
            @foreach ($project->technologies as $technology)
            <li>{{$technology->title}}</li>
            @endforeach
        </ul>
        <p><strong>Descrizione: </strong>{{$project['description']}}</p>
    </div>
</div>
@endsection