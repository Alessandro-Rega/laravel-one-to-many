@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-header mb-4">
                <h5>Crea Categoria</h5>
            </div>
            <form action="{{route('category.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Name</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome" value="{{old('name')}}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Crea</button>
            </form>
        </div>
    </div>
</div>
@endsection