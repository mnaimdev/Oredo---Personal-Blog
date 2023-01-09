@extends('layouts.dashboard')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Post</li>
            <li class="breadcrumb-item active" aria-current="page">Add Post</li>
        </ol>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Post</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Category</label>
                                <select name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Short Description</label>
                                <input type="text" class="form-control" name="short_desp">
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea id="summernote" name="desp"cols="60" rows="20" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <h3>Add Tags</h3>
                                @foreach ($tags as $tag)
                                    <input type="checkbox" name="tag_id[]" value="{{ $tag->id }}">
                                    {{ $tag->tag_name }}
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <label>Featured Image</label>
                                <input class="form-control" type="file" name="feat_image">
                                @error('feat_image')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Add Post</button>
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
