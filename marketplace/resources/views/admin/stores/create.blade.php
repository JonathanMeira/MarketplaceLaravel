@extends('layouts.app')

@section('content')

<h1>
    Create Store
</h1>

<form action="/admin/stores/store" method="post">
<input type="hidden" name="_token" value="{{csrf_token()}}">

<div class="form-group">
    <label>Store name</label>
    <input type="text" name="name" class="form-control">
</div>

<div class="form-group">
    <label for="">Description</label>
    <input type="text" name="description" class="form-control">
</div>

<div class="form-group">
    <label for="">Telephone</label>
    <input type="text" name="phone" class="form-control">
</div>

<div class="form-group">
    <label for="">Mobile phone</label>
    <input type="text" name="mobile_phone" class="form-control">
</div>

<div class="form-group">
    <label for="">Slug</label>
    <input type="text" name="slug" class="form-control">
</div>

<div class="form-group">
    <label for="">User</label>
    <select name="user" class="form-control">
        @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
    </select>
</div>
<div>
    <button type="submit" class="btn btn-lg btn-success">Create new store</button>
</div>

</form>
@endsection