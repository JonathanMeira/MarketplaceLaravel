@extends('layouts.front')


@section('stylesheets')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('content')
<div class="container">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12 msg">

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Checkout order</h2>
                <hr>
            </div>
        </div>
        <form action="" method="post">
        <div class="row">
                <div class="form-group col-md-12">
                    <label>Person's card name</span></label>
                    <input type="text" name="card_name"class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label>Card number <span class="brand"></span></label>
                    <input type="text" name="card_number"class="form-control">
                    <input type="hidden" name="card_brand">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label>Month expiration</label>
                    <input type="text" name="card_month"class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label>Year expiration</label>
                    <input type="text" name="card_year"class="form-control">
                </div>
            </div>

            <div class="row">

                <div class="form-group col-md-5">
                    <label>Security number</label>
                    <input type="text" name="card_cvv"class="form-control">
                </div>

                <div class="col-md-12 installments form-group"></div>
            </div>

            <button class="btn btn-success btn-lg processCheckout">Place order</button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
     const sessionId = '{{session()->get('pagseguro_session_code')}}';
     const urlThanks = '{{route('checkout.thanks')}}';
     const urlProccess = '{{route("checkout.proccess")}}';
     const amoutTransaction = '{{$cartItems}}';
     const csrf = '{{csrf_token()}}';

    PagSeguroDirectPayment.setSessionId(sessionId);
</script>

<script src="{{asset('js/pagseguro_functions.js')}}"></script>
<script src="{{asset('js/pagseguro_events.js')}}"></script>
@endsection 