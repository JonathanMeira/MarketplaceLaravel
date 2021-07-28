@extends('layouts.app')

@section('content')

<a href="{{route('admin.products.create')}}" class="btn btn-lg btn">Create new product</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Product name</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->price}}</td>
            <td>
                <a href="{{route('admin.products.edit',['product' =>$product->id])}}" class="btn btn-sm btn-info">EDIT</a>
                <a href="{{route('admin.products.destroy',['product' =>$product->id])}}" class="btn btn-sm btn-danger">REMOVE</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
    {{$products->links()}}
@endsection