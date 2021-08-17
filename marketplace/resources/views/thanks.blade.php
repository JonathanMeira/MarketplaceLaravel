@extends('layouts.front')  

@section('content')
    <h2 class="alert alert-success">
        Thank you for purchasing with us! 
    </h2>
    <h3>
        Your order has been placed. Your code number: {{request()->get('order')}}'.
    </h3>
@endsection