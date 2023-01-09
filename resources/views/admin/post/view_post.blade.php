@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>View Post</h3>
                    </div>
                    <div class="card-body">
                        <h3 class="mb-2">{{ $post->title }}</h3>
                        <img src="{{ asset('/uploads/post') }}/{{ $post->feat_image }}" alt="">
                        <p class="mt-3">{!! $post->desp !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
