@extends('frontend.webside')
@section('content')
    <section>
    <div class="hero-wrap" style="background-image: url('/frontend/images/bg_1.jpg')">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
                    <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                        <div class="text">
                            <p class="breadcrumbs mb-2">
                                <span class="mr-2"><a
                                        href="{{route('website')}}">Home</a></span> <span>Demo</span></p>
                            <h1 class="mb-4 bread">Demo Page</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="ftco-section contact-section bg-light">
        <div class="container">
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-12 mb-4">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Number</th>
                            </tr>
                        </thead>
                        <tbody> 

                            @foreach ($alldata as $key => $item)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>{{$item->amount}}</td>
                                    <td>{{$item->number}}</td>
                                </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection
