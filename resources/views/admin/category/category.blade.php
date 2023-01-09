@extends('layouts.dashboard')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Category</li>
        </ol>

    </nav>

    <div class="container-fluid">
        <div class="row">
            @can('show_category')
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3>Category List</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($categories as $sl => $category)
                                    <tr>
                                        <td>{{ $sl + 1 }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>
                                            <img src="{{ asset('/uploads/category') }}/{{ $category->cat_img }}" alt="">
                                        </td>
                                        <td>
                                            @can('update_category')
                                                <a href="{{ route('category.edit', $category->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                            @endcan

                                            <a data-link="{{ route('category.delete', $category->id) }}"
                                                class="btn btn-danger del">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            @endcan
            @can('add_category')
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add Category</h3>
                        </div>
                        <div class="card-body">

                            <form class="forms-sample" action="{{ route('category.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Category Name</label>
                                    <input type="text" class="form-control" id="exampleInputUsername1" name="category_name"
                                        value="{{ old('category_name') }}">
                                    @error('category_name')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="file" name="cat_img" class="form-control" id="exampleInput">
                                    @error('cat_img')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>

                            </form>
                        </div>
                    </div>


                </div>
            @endcan
        </div>
    </div>
    </div>
    </div>
@endsection

@section('footer_script')
    <script>
        $('.del').click(function() {

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var link = $(this).attr('data-link');
                    window.location.href = link;
                }
            })

        });
    </script>

    @if (session('delete'))
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('delete') }}",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@endsection
