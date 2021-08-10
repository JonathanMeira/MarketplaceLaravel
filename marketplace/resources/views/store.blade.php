@extends('layouts.front')

@section('content')
    <div class="row front">

        <div class="col-3">
            @if($store->logo)
                <img src="{{asset('storage/'.$store->logo)}}" alt="{{$store->name}}'s logo" class="img-fluid rounded">
            @else
                <img src="https://via.placeholder.com/600X300.png?text=logo" alt="Store without logo" class="img-fluid rounded">
            @endif
        </div>
        <div class="col-9">
            <h2>{{$store->name}}</h2>
            <p>{{$store->description}}</p>
            <p>
                <strong>Contact store:</strong>
                <span>{{$store->phone}}</span> | <span>{{$store->mobile_phone}}</span>
            </p>
        </div>
        
        <div class="col-12 mb-3">
            <hr>
            <h3>Store's products:</h3>
        </div>
    @forelse($store->products as $key => $product)
            <div class="col-md-4">
                <div class="card" style="width: 98%;">       
                    @if($product-> photos->count())
                        <img src="{{ asset('storage/'.$product-> photos->first()->image) }}" class="card-img-top">
                    @else
                        <img src="{{ asset('assets/img/no-photo.jpg') }}" class="card-img-top">
                    @endif
                    
                    <div class="card-body">
                        <h2 class="card-title">
                            {{$product->name}}
                        </h2>
                        <p class="card-text">
                            {{$product->description}}
                        </p>
                        <h3>
                            R$ {{number_format($product -> price,'2', '.' , ',')}}
                        </h3>
                    <a href="{{route('product.single',['slug'=> $product ->slug])}}" class="btn btn-outline-secondary  d-flex justify-content-center">
                        BUY
                    </a>

                    </div>
                </div> 
            </div>
        @if(($key+1)% 3 == 0)</div><div class="row front">@endif
        @empty
            <div class="col-12">
                <h3 class="alert alert-warning">Products unavailable for this store</h3>
            </div>
    @endforelse
    </div>
@endsection