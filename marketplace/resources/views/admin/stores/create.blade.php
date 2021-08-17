@extends('layouts.app')

@section('content')

<h1>
    Create Store
</h1>

<form action="{{route('admin.stores.store')}}" method="post" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}">

<div class="form-group">
    <label>Store name</label>
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
    <label for="">Telephone</label>
    <input type="text" name="phone" id="phone"class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}">
    @error('phone')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="">Mobile phone</label>
    <input type="text" name="mobile_phone" id = "mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror" value="{{old('phone_number')}}">
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
</div>



<div class="form-group">
    <label for="">Slug</label>
    <input type="text" name="slug" class="form-control" disabled="true">
</div>

<div>
    <button type="submit" class="btn btn-lg btn-success">Create new store</button>
</div>

</form>
@endsection

@section('scripts')
<script>
    let imPhone = new Inputmask("(999) 999-9999");
    imPhone.mask(document.getElementById("phone"));

    let imMobilePhone = new Inputmask("(999) 999-9999");
    imMobilePhone.mask(document.getElementById("mobile_phone"));
</script>
@endsection