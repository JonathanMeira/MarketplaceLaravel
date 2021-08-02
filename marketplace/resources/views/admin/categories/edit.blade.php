@extends('layouts.app')


@section('content')
    <h1>Edit category</h1>
    <form action="{{route('admin.categories.update', ['category' => $category->id])}}" method="post">
        @csrf
        @method("PUT")

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$category->name}}">

            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Description</label>
            <input type="text" name="description" class="form-control" value="{{$category->description}}">
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" value="{{$category->slug}}">
        </div>

        <div>
            <button type="submit" class="btn btn-lg btn-success">Edit category info</button>
        </div>
    </form>
@endsection