@extends('frontend.master')

@section('content')
    <div class="section-heading ">
        <div class="container-fluid">
            <div class="section-heading-2">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading-2-title">
                            <h1>About us</h1>
                            <p class="links"><a href="{{ route('welcome') }}">Home <i class="las la-angle-right"></i></a>
                                pages</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--about-us-->
    <section class="about-us">
        <div class="container-fluid">
            <div class="about-us-area">
                <div class="row ">
                    <div class="col-lg-12 ">
                        <div class="image">
                            <img src="{{ asset('/frontend_asset/img/other/about.jpg') }}" alt="">
                        </div>

                        <div class="description">
                            <h3>Thank you for checking out our blog website.</h3>
                            <p>
                                We are here to provide important knowledge, thinking and posts that a person can be
                                benefited. This website has many pages to handle different kind of pages. There are some
                                interesting categories, tags and so more. Please follow our website so that we can parovide
                                information and help you.
                            </p>
                            <a href="{{ route('contact') }}" class="btn-custom">Contact us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
