@extends('layouts.dashboard')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Post</li>
            <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
        </ol>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Post</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('post.edit.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $post_info->title }}">
                                <input type="hidden" name="post_id" value="{{ $post_info->id }}">
                            </div>
                            <div class="mb-3">
                                <label>Category</label>
                                <select name="category_id">
                                    @foreach ($categories as $category)
                                        <option {{ $post_info->category_id == $category->id ? 'selected' : '' }}
                                            value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Short Description</label>
                                <input type="text" class="form-control" name="short_desp"
                                    value="{{ $post_info->short_desp }}">
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea id="summernote" name="desp"cols="60" rows="20" class="form-control">
                                    {!! $post_info->desp !!}
                                </textarea>
                            </div>
                            <div class="mb-3">
                                <h3>Add Tags</h3>
                                @php
                                    $after_explode = explode(',', $post_info->tag_id);
                                @endphp
                                @foreach ($tags as $main_tag)
                                    <input
                                        @foreach ($after_explode as $tag)
                                            {{ $tag == $main_tag->id ? 'checked' : '' }} @endforeach
                                        type="checkbox" name="tag_id[]" value="{{ $main_tag->id }}">
                                    {{ $main_tag->tag_name }}
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <label>Featured Image</label>
                                <input class="form-control" type="file" name="feat_image">
                            </div>
                            <div class="mb-5">
                                <img width="200" src="{{ asset('/uploads/post/' . $post_info->feat_image) }}"
                                    alt="">
                            </div>
                            <div class="mt-3 text-center">
                                <button type="submit" class="btn btn-primary form-control w-50 ">Update
                                    Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection
