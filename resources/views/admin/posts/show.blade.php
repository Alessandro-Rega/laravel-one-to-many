@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card my-4">
                <div class="card-header">
                    <h3>{{$post->title}}</h3>
                    @if(isset($post->category->name))
                    <h6>Categoria: {{$post->category->name}}</h6>
                    @else
                    <h6>Categoria: </h6>
                    @endif
                </div>
                @if($post->image)
                    <img src="{{asset("storage/{$post->image}")}}" alt="{{$post->title}}">
                @endif
                <div class="card-body">
                    <p>{{$post->content}}</p>
                </div>
                <div class="card-body">
                    <span>Stato: </span>
                    @if ($post->published)
                        <span class="text-success">Pubblicato</span>
                    @else
                        <span class="text-secondary">Non Pubblicato</span>
                    @endif
                </div>
                <div class="card-body d-flex">
                    <a href="{{route('posts.index', $post->id)}}"><button type="button" class="btn btn-primary">Vai ai Post</button></a>
                    @if(isset($post->category->name))
                    <a href="{{route('category.show', $post->category->id)}}" class="ml-2"><button type="button" class="btn btn-primary">Vai alla Categoria</button></a>
                    @else
                    <a href="{{route('category.index')}}" class="ml-2"><button type="button" class="btn btn-primary">Vai alle Categoria</button></a>
                    @endif
                    <a href="{{route('posts.edit', $post->id)}}" class="mx-2"><button type="button" class="btn btn-warning">Modifica</button></a>
                    <form action="{{route("posts.destroy", $post->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="sumbit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection