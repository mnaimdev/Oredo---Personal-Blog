@extends('layouts.dashboard');

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Category</li>
            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
        </ol>

    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Category</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="category_name" class="form-control"
                                    value="{{ $category->category_name }}">
                                <input type="hidden" name="id" value={{ $category->id }}>
                            </div>
                            <div class="form-group">
                                <input type="file" name="cat_img" class="form-control" placeholder="Category Image"
                                    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="mb-3">
                                <img id="blah" src="{{ asset('/uploads/category/' . $category->cat_img) }}"
                                    height="150" width="200" alt="">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
