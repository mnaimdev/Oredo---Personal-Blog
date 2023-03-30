@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Show Post</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>Category</th>
                                <th>Title</th>

                                <th>Feat Image</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($mypost as $sl => $post)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $post->rel_to_category->category_name }}</td>
                                    <td>
                                        @php
                                            $truncated = Str::limit($post->title, 25, '...');
                                        @endphp

                                        {{ $truncated }}
                                    </td>

                                    <td>
                                        <img width="100" src="{{ asset('/uploads/post') }}/{{ $post->feat_image }}"
                                            alt="">
                                    </td>
                                    <td>
                                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">Edit</a>

                                        <a href="{{ route('post.view', $post->id) }}" class="btn btn-info">View</a>

                                        <a href="{{ route('post.delete', $post->id) }}" class="btn btn-danger">X</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
