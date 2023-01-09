@extends('frontend.master')

@section('content')
    <section class="login">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-8 m-auto">
                    <div class="login-content">
                        <h4>Guest Profile Update</h4>
                        <form action="{{ route('guest.profile.update') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username*" name="name"
                                    value="{{ Auth::guard('guestlogin')->user()->name }}">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email*" name="email"
                                    value="{{ Auth::guard('guestlogin')->user()->email }}">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Old Password*" name="old_password">
                                @if (session('old'))
                                    <strong class="text-danger">
                                        {{ session('old') }}
                                    </strong>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="New Password*" name="new_password">
                            </div>

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
