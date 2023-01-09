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
                                <th>Tags</th>
                                <th>Author Id</th>
                                <th>Feat Image</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($mypost as $sl => $post)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $post->rel_to_category->category_name }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>
                                        @php
                                            $after_explode = explode(',', $post->tag_id);
                                        @endphp
                                        @foreach ($after_explode as $tag_id)
                                            @php
                                                $tag_item = App\Models\Tag::where('id', $tag_id)->get();
                                            @endphp
                                            @foreach ($tag_item as $tag)
                                                <span class="badge badge-primary">{{ $tag->tag_name }}</span>
                                            @endforeach
                                        @endforeach

                                        {{-- @php
                                            $after_explode = explode(',', $post->tag_id);
                                        @endphp
                                        @foreach ($after_explode as $tag_id)
                                            @php
                                                $tag_items = App\Models\Tag::where('id', $tag_id)->first()->tag_name;
                                            @endphp
                                            <span class="badge badge-dark">{{ $tag_items }}</span>
                                        @endforeach --}}
                                    </td>
                                    <td>{{ $post->author_id }}</td>
                                    <td>
                                        <img width="100" src="{{ asset('/uploads/post') }}/{{ $post->feat_image }}"
                                            alt="">
                                    </td>
                                    <td>
                                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">Edit</a>

                                        <a href="{{ route('post.view', $post->id) }}" class="btn btn-info">View</a>

                                        <a href="{{ route('post.delete', $post->id) }}" class="btn btn-danger">Delete</a>
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
