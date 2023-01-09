@extends('frontend.master')

@section('content')
    <section class="login">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-8 m-auto">
                    <div class="login-content">
                        <h4>Verify Your Email</h4>
                        <form action="{{ route('mail.verify.again') }}" method="post">
                            @csrf

                            @if (session('verify_req'))
                                <div class="alert alert-warning">
                                    {{ session('verify_req') }}
                                </div>
                            @endif
                            @if (session('mail_again'))
                                <div class="alert alert-info">
                                    {{ session('mail_again') }}
                                </div>
                            @endif
                            <div class="form-group">

                                <input type="email" class="form-control" placeholder="Email*" name="email"
                                    value="{{ session('mail') }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn-custom">Send Request Again</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
