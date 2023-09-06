@extends('frontend.webside')
@section('content')

    <div class="hero-wrap" style="background-image: url('/frontend/images/bg_1.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
                <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                    <div class="text">
                        <p class="breadcrumbs mb-2"><span class="mr-2"><a href="{{route('website')}}">Home</a></span>
                            <span>About</span></p>
                        <h1 class="mb-4 bread">About Us</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class=" ftc-no-pb ftc-no-pt">

        <div class="arif_container">
            <div class="row">
                <div class="col-md-7 py-5 wrap-about pb-md-5 ftco-animate">
                    <div class="heading-section-wo-line pt-md-5 pl-md-5 mb-5">
                        <div class="">
                            <h2 class="subheading text-sm">#Welcome to Sea Pearl Cox's Bazar</h2>
                            <span class="h2 text-lg capitalize">
                                Unwind The Pearl Of Luxury
                            </span>
                        </div>
                    </div>
                    <div class="pb-md-5">
                        <p>Sea Pearl Cox's Bazar Beach Resort & Spa is located on Inani beach, Cox's Bazar with lush
                            green hills rise from the east and endless sea stretching on the west, the resort offers
                            panoramic visuals of Bay of Bengal. Nestled in the heart of nature along the world’s longest
                            natural sandy beach, the resort is spread over 15 acres, located 40 minutes away from the
                            hustle of the Cox's Bazar city with easy accessibility to all the major tourist.</p>
                        <p>Apart from luxurious rooms & suites and two swimming pools (one exclusively for ladies) the
                            resort boasts of a plethora of indoor & outdoor activities for both adults and kids which
                            include an internationally acclaimed water park, tennis & badminton courts, 3D movie hall,
                            billiards, amphitheater, a luxurious spa and a well-appointed gym.</p>
                    </div>
                </div>

                <div class="col-md-5 pb-md-5 img img-2 d-flex justify-content-center align-items-center ftco-animate">
                    <ul>
                        <h2>Our Services</h2>
                        <li>Large Parking Area - 150 car at a time</li>
                        <li>Own Security System with Metal Detector & CCTV.</li>
                        <li>Own Power Supply System.</li>
                        <li>Round the Clock Room Service</li>
                        <li>Multimedia Projector Facility</li>
                        <li>Internet Facility [WiFi]</li>
                        <li>ISD Phone Facility</li>
                        <li>Health Club</li>
                        <li>Fully Equipt Gym</li>
                        <li>Tour Guide</li>
                        <li>Doctor on Call</li>
                        <li>Airport Transfer</li>
                        <li>Laundry Service</li>
                        <li>Helipad</li>
                        <li>Visa and Master Card</li>
                        <li>Bus Ticket Booking</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-counter img" id="section-counter" >
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="row">
                      <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                          <div class="text">
                            <strong class="number" data-number="400">0</strong>
                            <span>Happy Guests</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                          <div class="text">
                            <strong class="number" data-number="200">0</strong>
                            <span>Rooms</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                          <div class="text">
                            <strong class="number" data-number="100">0</strong>
                            <span>Staffs</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                          <div class="text">
                            <strong class="number" data-number="50">0</strong>
                            <span>Users</span>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            </div>
    </section>

@endsection
