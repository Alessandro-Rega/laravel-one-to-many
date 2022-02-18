@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-header mb-4">
                <a href="{{route('category.create')}}"><button type="button" class="btn btn-success">Crea Categoria</button></a>
            </div>
            <div class="card-header">
                <span>Categories</span>
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{$category->id}}</th>
                        <td>{{$category->name}}</td>
                        <td>{{$category->slug}}</td>
                        <td><a href="{{route('category.show', $category->id)}}"><button type="button" class="btn btn-primary">Visualizza</button></a></td>
                    </tr>
                @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection