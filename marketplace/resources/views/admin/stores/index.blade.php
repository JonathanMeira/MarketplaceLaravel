@extends('layouts.app')

@section('content')

<a href="{{route('admin.stores.create')}}" class="btn btn-lg btn">Create new store</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Store name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($stores as $store)
        <tr>
            <td>{{$store->id}}</td>
            <td>{{$store->name}}</td>
            <td>
                <div class="btn-group">
                    <a href="{{route('admin.stores.edit',['store' =>$store->id])}}" class="btn btn-sm btn-info">EDIT</a>
                    <form action="{{route('admin.stores.destroy',['store' =>$store->id])}}" method="post">
                        @csrf
                        @method("DELETE")
                    <button type="submit" class="btn btn-sm btn-danger">REMOVE</button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
    {{$stores->links()}}
@endsection