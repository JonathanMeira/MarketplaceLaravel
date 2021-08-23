@extends('layouts.front')  

@section('content')
    <h2 class="alert alert-success">
        Thank you for purchasing with us! 
    </h2>
    <h3>
        Your order has been placed. <br>Your code number: {{request()->get('order')}}.
         
        @if(request()->has('link'))
        <br>
        <a href="{{request()->get('link')}}" class="btn btn-lg btn-danger" target="_blank">Pay bank slip</a>
        @endif
    </h3>
@endsection