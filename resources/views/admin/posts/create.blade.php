@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-header mb-4">
                <h5>Crea Post</h5>
            </div>
            <form action="{{route('posts.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"" id="title" name="title" placeholder="Inserisci il titolo" value="{{old('title')}}">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror"" id="content" name="content" placeholder="Inserisci il contenuto" rows="10">{{old('content')}}</textarea>
                @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="published" id="published" {{old('published') ? 'checked' : ''}}>
                    <label class="form-check-label" for="published">Published</label>
                    @error('published')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Crea</button>
            </form>
        </div>
    </div>
</div>
@endsection