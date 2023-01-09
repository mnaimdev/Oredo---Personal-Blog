@extends('frontend.master')

@section('content')
    <section class="login">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-8 m-auto">
                    <div class="login-content">
                        <h4>Login</h4>
                        <form action="{{ route('guest.login.req') }}" method="post">
                            @csrf

                            @if (session('login'))
                                <div class="alert alert-danger">
                                    {{ session('login') }}
                                </div>
                            @endif
                            @if (session('pass_reset_success'))
                                <div class="alert alert-success">
                                    {{ session('pass_reset_success') }}
                                </div>
                            @endif
                            @if (session('verify_mail_confirm'))
                                <div class="alert alert-success">
                                    {{ session('verify_mail_confirm') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email*" name="email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password*" name="password">
                            </div>
                            <div class="sign-controls form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="rememberMe">
                                    <label class="custom-control-label" for="rememberMe">Remember Me</label>
                                </div>
                                <a href="{{ route('guest.pass.reset.req') }}" class="btn-link ">Forgot Password?</a>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn-custom">Login in</button>
                            </div>
                            <div class="form-group">
                                <ul>
                                    <li class="bg-light py-2 text-center text-dark">
                                        <a href="{{ route('github.login') }}">Login With
                                            <img width="32"
                                                src="https://i.postimg.cc/RVQ39vVW/github.png
                                        "
                                                alt="">
                                        </a>
                                    </li>

                                    <li class="bg-light py-2 my-3 text-center text-dark">
                                        <a href="{{ route('google.login') }}">Login With
                                            <img width="32" src="https://i.postimg.cc/L6MqrJRd/google.png"
                                                alt="">
                                        </a>
                                    </li>

                                    <li class="bg-light py-2 my-3 text-center text-dark">
                                        <a href="{{ route('facebook.login') }}">Login With
                                            <img width="32" src="https://i.postimg.cc/9FnX5jQY/facebook-1.png">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <p class="form-group text-center">Don't have an account? <a href="{{ route('guest.register') }}"
                                    class="btn-link">Create One</a> </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
