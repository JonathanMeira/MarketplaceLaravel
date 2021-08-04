@extends('layouts.front')

@section('content')
<div class="row">
    <div class="col-12">
            <h2>Cart</h2>
            <hr>
    </div>
    <div class="col-12">
        @if($cart)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach($cart as $c)
                <tr>
                    <td>{{$c['name']}}</td>
                    <td>R$ {{number_format($c['price'], 2,'.', ',')}}</td>
                    <td>{{$c['amount']}}</td>

                    @php
                        $subtotal = $c['price'] * $c['amount'];
                        $total += $subtotal;
                    @endphp


                    <td>R$ {{number_format($subtotal, 2,'.', ',')}}</td>
                    <td>
                        <a href="{{route('cart.remove',['slug' =>$c['slug']])}}" class="btn btn-sm btn-danger">REMOVE</a>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3">Total:</td>
                    <td colspan="2">R$ {{number_format($total,2,'.',',')}}</td>
                </tr>
            </tbody>
        </table> 

        <hr>
        <div class="col-md-12">
            <a href="{{route('checkout.index')}}" class="btn btn-lg btn-success pull-right">Checkout</a>
            <a href="{{route('cart.cancel')}}" class="btn btn-lg btn-danger pull-left">Cancel purchase</a>
        </div>

        @else
        <div class="alert alert-warning">Cart is empty</div>
        @endif
    </div>
</div>


@endsection