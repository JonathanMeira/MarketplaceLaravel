@extends('layouts.app')

@section('content')

<h1>
    Create Product
</h1>

<form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
    @csrf

<div class="form-group">
    <label>Product name</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
    @error('name')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="">Description</label>
    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}">
    @error('description')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="">Content</label>
    <textarea name="body" id="" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror" value="{{old('body')}}"></textarea>
    @error('body')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="">Price</label>
    <input type="text" name="price" id ="price" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}">
    @error('price')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

<div class="form-group">
    <label>Categories</label>
    <select name="categories[]" class="form-control" multiple>
        @foreach($categories as $category)
        <option value="{{$category -> id}}">{{$category -> name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Product's photos</label>
    <input type="file"  name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" multiple>
    @error('photos.*')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="">Slug</label>
    <input type="text" name="slug" class="form-control" disabled="true">
</div>

<div>
    <button type="submit" class="btn btn-lg btn-success">Create new product</button>
</div>

</form>
@endsection

@section('scripts')
    <script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>
    <script>
        $('#price').maskMoney({
            prefix: '',
            allowNegative: false,
            thousands: ',',
            decimal: '.'
        });
    </script>
@endsection