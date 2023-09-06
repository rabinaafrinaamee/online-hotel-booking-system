

@extends('frontend.webside')
@section('content')

 <section class="ftco-section bg-light">
    	<div class="container">
		<div class="d-flex justify-content-center mb-2 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
              <h3 class="text-center text-xl font-semibold"> {{ $trans }} </h3>
          </div>
        </div>
    		<div class="d-flex justify-content-center my-5">
                <div class="justify-center">

                        @if(isset($order->name))
                            <p>
                                <strong>Customer Name: </strong> {{ $order->name }} <br>
                                <strong>Customer Email: </strong> {{ $order->email }} <br>
                                <strong>Customer Phone: </strong> {{ $order->contact }} <br>
                                <strong>Customer Address: </strong> {{ $order->address }} <br>
                            </p>
                        @endif
                    <ul>
                        <li>Transaction ID: {{ $order->tran_id }} </li>
                        <li>Amount Paid: {{ $order->total_amount }} </li>
                        <li>Current Status: {{ $order->status }} </li>
                    </ul>
                    <h3 class="text-center text-xl font-semibold"> {{ $message }} </h3>
                </div>
    		</div>
    	</div>
    @endsection
