@extends('layouts.dashboard')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tag</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Tag List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($tags as $sl => $tag)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $tag->tag_name }}</td>
                                    <td>
                                        <a href="" class="btn btn-danger">
                                            x
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Add Tag</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tag.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label>Tag Name</label>
                                <input type="text" name="tag_name" class="form-control">
                                @error('tag_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
