@extends('frontend.master')

@section('content')
    <div class="section-heading ">
        <div class="container-fluid">
            <div class="section-heading-2">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading-2-title">
                            <h1>Contact us</h1>
                            <p class="links"><a href="{{ route('welcome') }}">Home <i class="las la-angle-right"></i></a>
                                pages</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--contact-->
    <section class="contact">
        <div class="container-fluid">
            <div class="contact-area">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-image">
                            <img src="{{ asset('/frontend_asset/img/other/contact.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-info">
                            <h3>feel free to contact us</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate deserunt suscipit error
                                deleniti
                                porro, pariatur voluptatem iste quos maxime aspernatur.</p>
                        </div>
                        <!--form-->
                        <form action="{{ route('contact.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Name*">
                                @error('name')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email*">
                                @error('email')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" name="subject" class="form-control" placeholder="Subject*">
                                @error('subject')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                <textarea name="message" cols="30" rows="5" class="form-control" placeholder="Message*"></textarea>
                                @error('message')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                @enderror
                            </div>

                            <button class="btn-custom" type="submit">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
