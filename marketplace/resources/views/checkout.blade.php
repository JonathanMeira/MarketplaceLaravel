@extends('layouts.front')

@section('content')
<div class="container">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <h2>Checkout order</h2>
                <hr>
            </div>
        </div>


        <form action="" method="post">
            <div class="row">
                <div class="form-group col-md-12">
                    <label>Card number <span class="brand"></span></label>
                    <input type="text" name="card_number"class="form-control">
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
            </div>

            <button class="btn btn-success btn-lg">Place order</button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script type="text/javascript">
     const sessionId = '{{session()->get('pagseguro_session_code')}}';
    PagSeguroDirectPayment.setSessionId(sessionId);

</script>

<script>
    let cardNumber = document.querySelector('input[name=card_number]');
    let spanBrand = document.querySelector('span.brand');
    cardNumber.addEventListener('keyup', function(){
        if(cardNumber.value.length >= 6){
            PagSeguroDirectPayment.getBrand({
                cardBin: cardNumber.value.substr(0,6),
                success: function(res){
                    let imgFlag = `<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${res.brand.name}.png">`;

                    spanBrand.innerHTML = imgFlag;
                },
                error: function(err){console.log(err)},
                complete: function(res){
                    //console.log(res)
                }
            });
        }
    })
</script>



@endsection