@extends('layouts.app')

@section('content')

<h1>
    Edit Store
</h1>

<form action="{{route('admin.stores.update',['store' => $store->id])}}" method="post">
<input type="hidden" name="_token" value="{{csrf_token()}}">

<div class="form-group">
    <label>Store name</label>
    <input type="text" name="name" class="form-control" value="{{$store->name}}">
</div>

<div class="form-group">
    <label for="">Description</label>
    <input type="text" name="description" class="form-control" value="{{$store->description}}">
</div>

<div class="form-group">
    <label for="">Telephone</label>
    <input type="text" name="phone" class="form-control" value="{{$store->phone}}">
</div>

<div class="form-group">
    <label for="">Mobile phone</label>
    <input type="text" name="mobile_phone" class="form-control" value="{{$store->mobile_phone}}">
</div>

<div class="form-group">
    <label for="">Slug</label>
    <input type="text" name="slug" class="form-control" value="{{$store->slug}}">
</div>


<div>
    <button type="submit" class="btn btn-lg btn-success">Update store</button>
</div>

</form>
@endsection