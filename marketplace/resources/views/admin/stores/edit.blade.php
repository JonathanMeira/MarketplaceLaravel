@extends('layouts.app')

@section('content')

<h1>
    Edit Store
</h1>

<form action="{{route('admin.stores.update',['store' => $store->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("PUT")

<div class="form-group">
    <label>Store name</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$store->name}}">
    @error('name')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="">Description</label>
    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{$store->description}}">
    @error('description')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="">Telephone</label>
    <input type="text" name="phone" class="form-control  @error('phone') is-invalid @enderror" value="{{$store->phone}}">
    @error('phone')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="">Mobile phone</label>
    <input type="text" name="mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror" value="{{$store->mobile_phone}}">
    @error('mobile_phone')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>

<div class="form-group">
    <label>Store's logo</label>
    <input type="file"  name="logo" class="form-control @error('logo') is-invalid @enderror">
    @error('logo') 
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
    <p>
        @if($store->logo)
                <img src="{{asset('storage/'.$store->logo)}}" alt="{{$store->name}}'s logo" class="img-fluid rounded">
        @endif
    </p>
</div>

<div class="form-group">
    <label for="">Slug</label>
    <input type="text" name="slug" class="form-control" value="{{$store->slug}}" disabled="true">
</div>


<div>
    <button type="submit" class="btn btn-lg btn-success">Update store</button>
</div>

</form>
@endsection