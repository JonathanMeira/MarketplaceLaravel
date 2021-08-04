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
                    <label>Card number</label>
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