@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="m-3">Lista dei Tipi</h2>

    <ul>
        @foreach ($types as $type)
        <li class="m-2">
            <div class="w-75">
                <div class="d-flex justify-content-between align-items-center mb-1 mt-3">
                    <div>
                        <a href="{{route('admin.types.show', $type)}}">
                            <span class="title"><strong>{{$type['title']}}</strong></span>
                        </a>
                    </div>
                    <div class="d-flex">
                        <a href="{{route('admin.types.edit', $type)}}">
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

    <a href="{{route('admin.types.create')}}">
        <button class="btn btn-outline-secondary mx-3">Crea nuovo tipo</button>
    </a>
</div>
@endsection