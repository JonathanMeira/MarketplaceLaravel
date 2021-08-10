@extends('layouts.front')  

@section('content')
    <h2 class="alert alert-success">
        Your order has been placed. Your code number: {{request()->get('order')}}.
    </h2>
    <h3>
        Thank you for purchasing with us! 
    </h3>
@endsection