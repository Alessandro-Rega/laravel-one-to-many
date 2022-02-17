@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-header mb-4">
                <a href="{{route('category.create')}}"><button type="button" class="btn btn-success">Crea Categoria</button></a>
            </div>
            @foreach ($categories as $category)
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
            @endforeach
        </div>
    </div>
</div>
@endsection