@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="m-3">Crea un nuovo progetto</h2>

    <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data" class="m-3">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control @if ($errors->get('title')) is-invalid @endif" id="title" name="title" value="{{old('title')}}">
            @if ($errors->get('title'))
            @foreach ($errors->get('title') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control @if ($errors->get('description')) is-invalid @endif" id="description" rows="3" name="description">{{old('description')}}</textarea>
            @if ($errors->get('description'))
            @foreach ($errors->get('description') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-select @if ($errors->get('type_id')) is-invalid @endif" aria-label=" Default select example" id="type" name="type_id">
                <option selected>Seleziona il tipo</option>
                @foreach ($types as $type)
                <option value="{{$type->id}}" @if (old('type_id')==$type->id) selected @endif>{{$type->title}}</option>
                @endforeach
            </select>
            @if ($errors->get('type_id'))
            @foreach ($errors->get('type_id') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>

        <div class="mb-3">
            <label for="technologies" class="form-label">Technologies</label>
            <div class="d-flex flex-wrap">
                @foreach ($technologies as $technology)
                <div class="col-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="technology-{{$technology->id}}" value="{{$technology->id}}" name="technologies[]" {{in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="technology-{{$technology->id}}">{{$technology->title}}</label>
                    </div>
                </div>
                @endforeach
            </div>
            @if ($errors->has('technologies'))
            <div class="invalid-feedback d-block">
                @foreach ($errors->get('technologies') as $message)
                {{ $message }}<br>
                @endforeach
            </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="cover-img" class="form-label">Cover image</label>
            <input class="form-control @if ($errors->get('cover_img')) is-invalid @endif" type="file" name="cover_img" id="cover-img">
            @if ($errors->get('cover_img'))
            @foreach ($errors->get('cover_img') as $message)
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @endforeach
            @endif
        </div>
        <button type="submit" class="btn btn-outline-secondary">Crea progetto</button>
    </form>
</div>
@endsection