@extends('frontend.webside')

@section('content')

    <section>
        <div class="hero-wrap" style="background-image: url('/frontend/images/bg_1.jpg')">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
                    <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                        <div class="text">
                            <p class="breadcrumbs mb-2"><span class="mr-2"><a
                                        href="{{route('website')}}">Home</a></span> <span>Contact</span></p>
                            <h1 class="mb-4 bread">Contact Us</h1>
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
                    <h2 class="h3">Contact Information</h2>
                </div>
                @if(isset($hotel) && !empty($hotel))
                    <div class="col-md-3 d-flex">
                        <div class="info bg-white p-4">
                            <p><span>Address: </span> <a href="tel://1234567920">{{$hotel->Address}}</a></p>
                        </div>
                    </div>

                    <div class="col-md-3 d-flex">
                        <div class="info bg-white p-4">
                            <p><span>Email: </span> <a href="mailto:info@yoursite.com">{{$hotel->Email}}</a></p>
                        </div>
                    </div>

                    <div class="col-md-3 d-flex">
                        <div class="info bg-white p-4">
                            <p><span>Phone: <br></span> <a href="tel://01234567920">{{$hotel->Contact}}</a></p>
                        </div>
                    </div>

                    <div class="col-md-3 d-flex">
                        <div class="info bg-white p-4">
                            <p><span>Website:<br> </span> <a href="#">{{$hotel->Website}}</a></p>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row block-9">
                <div class="col-md-6 order-md-last d-flex">

                    <form action="{{route('guest.store')}}" method="post" class="bg-white p-5 contact-form">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" required placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" required placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <input type="text" name="subject" class="form-control" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <textarea name="massage" id="" cols="30" rows="7" class="form-control" required
                                      placeholder="Message"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary py-3 px-5">
                                Send Message
                            </button>
                        </div>
                    </form>

                </div>

                <div class="col-md-6 d-flex">
                    <div id="map" class="bg-white">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3719.408360250062!2d92.04631907539208!3d21.215649480480845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30addb98f90b08b7%3A0x6c678eda6bd69230!2sSea%20Pearl%20Beach%20Resort%20%26%20Spa%20Cox&#39;s%20Bazar!5e0!3m2!1sen!2sbd!4v1690278123356!5m2!1sen!2sbd"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
