@extends('layouts.dashboard')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">Update Profile</div>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('update.profile') }}" method="post">
                        @csrf
                        <div class="form-group">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputUsername1"
                                autocomplete="off" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                value="{{ Auth::user()->email }}">
                            @error('email')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Bio</label>
                            <textarea name="bio" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Old Password</label>
                            <input type="password" name="old_password" class="form-control" id="exampleInputPassword1"
                                autocomplete="off" placeholder="Old Password">
                            @if (session('error'))
                                <strong class="text-danger">{{ session('error') }}</strong>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">New Password</label>
                            <input type="password" name="new_password" class="form-control" id="exampleInputPassword1"
                                autocomplete="off" placeholder="New Password">
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Image Update</h3>
                </div>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('update.photo') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        @if (session('success-img'))
                            <div class="alert alert-success">{{ session('success-img') }}</div>
                        @endif
                        <div class="form-group">
                            <input type="file" name="photo">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
