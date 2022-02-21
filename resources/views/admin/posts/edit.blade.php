@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-header mb-4">
                <h5>Modifica: {{$post->title}}</h5>
            </div>
            <form action="{{route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"" id="title" name="title" placeholder="Inserisci il titolo" value="{{old('title') ? old('title') : $post->title}}">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror"" id="content" name="content" placeholder="Inserisci il contenuto" rows="10">{{old('content') ? old('content') : $post->content}}</textarea>
                @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                <div class="mb-3 d-flex flex-column">
                    <label for="image" class="form-label mb-2">Scegli un'immagine</label><br>
                    @if($post->image)
                    <img class="img-fluid img-thumbnail w-25 my-3" src="{{asset("storage/{$post->image}")}}" alt="">
                    @endif
                    <input type="file" class="@error('image') is-invalid @enderror" id="image" name="image">
                </div>
                <div>
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="custom-select @error('category_id') is-invalid @enderror" name="category_id" id="category">
                        <option value="">Seleziona la categoria</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{old("category_id", $post->category_id) == $category->id ? "selected" : ""}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 form-check">
                    @php
                        $published = old('published') ? old('published') : $post->published; 
                    @endphp
                    <input type="checkbox" class="form-check-input" name="published" id="published" {{$published ? 'checked' : ''}}>
                    <label class="form-check-label" for="published">Published</label>
                    @error('published')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-warning">Modifica</button>
            </form>
            <div class="mt-4">
                <a href="{{route('posts.show', $post->id)}}"><button type="button" class="btn btn-primary">Indietro</button></a>
            </div>
        </div>
    </div>
</div>
@endsection