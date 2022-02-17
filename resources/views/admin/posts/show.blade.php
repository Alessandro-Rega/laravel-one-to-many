@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card my-4">
                <div class="card-header">
                    <h3>{{$post->title}}</h3>
                </div>
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
                    <a href="{{route('posts.index')}}"><button type="button" class="btn btn-primary">Indietro</button></a>
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