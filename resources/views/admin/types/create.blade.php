@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="m-3">Crea un nuovo tipo</h2>

    <form action="{{route('admin.types.store')}}" method="POST" enctype="multipart/form-data" class="m-3">
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
        <button type="submit" class="btn btn-outline-secondary">Crea tipo</button>
    </form>
</div>
@endsection