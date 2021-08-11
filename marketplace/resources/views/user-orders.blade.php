@extends('layouts.front')

@section('content')

<div class="row">
    <div class="col-12">
        <h2>My orders</h2>
        <hr>
    </div>
</div>
<div class="col-12">
    <div id="accordion">
        @forelse($userOrders as $key => $order)
            <div class="card">
                <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                        Order number: {{$order->reference}}
                    </button>
                </h5>
                </div>

                <div id="collapse{{$key}}" class="collapse @if($key==0)show @endif" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <ul>
                        @php $items= unserialize($order->items) @endphp

                        @foreach($items as $item)
                            <li>
                                {{$item['name']}} | R$ {{number_format($item['price'] * $item['amount'], 2, '.', ',')}}
                                    <br>
                                Quantity demanded: {{$item['amount']}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @empty
            <div class="alert alert-warning">No orders placed</div>
        @endforelse
    </div>

    <div class="col-12">
        <hr>
        {{$userOrders->links()}}
    </div>

</div>


@endsection