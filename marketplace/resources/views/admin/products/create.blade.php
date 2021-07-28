@extends('layouts.app')

@section('content')

<h1>
    Create Product
</h1>

<form action="{{route('admin.products.store')}}" method="post">
    @csrf

<div class="form-group">
    <label>Product name</label>
    <input type="text" name="name" class="form-control">
</div>

<div class="form-group">
    <label for="">Description</label>
    <input type="text" name="description" class="form-control">
</div>

<div class="form-group">
    <label for="">Content</label>
    <textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
</div>

<div class="form-group">
    <label for="">Price</label>
    <input type="text" name="price" class="form-control">
</div>

<div class="form-group">
    <label for="">Slug</label>
    <input type="text" name="slug" class="form-control">
</div>

<div class="form-group">
    <label for="">Store</label>
    <select name="store" class="form-control">
        @foreach($stores as $store)
            <option value="{{$store->id}}">{{$store->name}}</option>
        @endforeach
    </select>
</div>
<div>
    <button type="submit" class="btn btn-lg btn-success">Create new product</button>
</div>

</form>
@endsection