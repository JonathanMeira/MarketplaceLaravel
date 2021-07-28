@extends('layouts.app')

@section('content')

<h1>
    Edit Product
</h1>

<form action="{{route('admin.products.store')}}" method="post">
<input type="hidden" name="_token" value="{{csrf_token()}}">

<div class="form-group">
    <label>Product name</label>
    <input type="text" name="name" class="form-control" value="{{$product -> name}}">
</div>

<div class="form-group">
    <label for="">Description</label>
    <input type="text" name="description" class="form-control" value="{{$product -> description}}">
</div>

<div class="form-group">
    <label for="">Content</label>
    <textarea name="body" id="" cols="30" rows="10" class="form-control" >{{$product -> body}}</textarea>
</div>

<div class="form-group">
    <label for="">Price</label>
    <input type="text" name="price" class="form-control" value="{{$product -> price}}">
</div>

<div class="form-group">
    <label for="">Slug</label>
    <input type="text" name="slug" class="form-control" value="{{$product -> slug}}">
</div>

<div>
    <button type="submit" class="btn btn-lg btn-success">Edit product info</button>
</div>

</form>
@endsection