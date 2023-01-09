@extends('frontend.master')

@section('content')
    <section class="login">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-8 m-auto">
                    <div class="login-content">
                        <h4>Login</h4>
                        <form action="{{ route('guest.pass.reset') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="New Password*" name="new_password">
                                <input type="hidden" name="token" value="{{ $token }}">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Confirm Password*"
                                    name="confirm_password">
                            </div>
                            @if (session('password_not_match'))
                                <div class="alert alert-danger">
                                    {{ session('password_not_match') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <button type="submit" class="btn-custom">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
