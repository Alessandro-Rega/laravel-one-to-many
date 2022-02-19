@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-header mb-3 d-flex justify-content-between">
                <form action="{{route('category.update', $category->id)}}" method="POST" class="w-50">
                    @csrf
                    @method('PUT')
                    <div class="d-flex align-items-center">
                        <label for="title" class="form-label mt-2">Name</label>
                        <input type="text" class="mx-2 w-50 form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome" value="{{old('name')}}">
                        <button type="submit" class="btn btn-warning">Modifica Categoria</button>
                    </div>
                    @error('name')
                        <div class="alert alert-danger w-50 p-1 ml-5">{{ $message }}</div>
                    @enderror
                </form>
                <div class="d-flex">
                    <a href="{{route('category.index')}}" class="mx-2"><button type="button" class="btn btn-primary">Indietro</button></a>
                    <form action="{{route("category.destroy", $category->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="sumbit" class="btn btn-danger">Elimina Categoria</button>
                    </form>
                </div>
            </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h1>{{$category->name}}</h1>
                        <h6>Slug: {{$category->slug}}</h6>
                    </div>
                    <div class="card-body pt-0">
                        <table class="table pt-0">
                            <thead>
                                <tr>
                                    <th scope="col">Titolo</th>
                                    <th scope="col">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category->posts as $item)
                                <tr>
                                    <td class="w-75">{{$item->title}}</td>
                                    <td><a href="{{route('posts.show', $item->id)}}"><button type="button" class="btn btn-primary">Visualizza</button></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection