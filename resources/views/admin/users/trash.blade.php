@extends('layouts.dashboard')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Trash Users</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-12 m-auto">
            <form action="{{ route('user.all') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3>Trash User List <span class="float-right">Total: {{ $total_trash }}</span></h3>
                        <button type="submit" name="action" value="restore" class="btn btn-primary">Restore Check</button>
                        <button type="submit" name="action" value="delete" class="btn btn-danger">Delete
                            Check</button>
                        <br>
                        <br>
                        @error('check')
                            <div class="alert alert-info">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">

                            <tr>
                                <th><input type="checkbox" id="checkAll"> Check All</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($trashes as $sl => $trash)
                                <tr>
                                    <td><input type="checkbox" name="check[]" value="{{ $trash->id }}"></td>
                                    <td>{{ $trash->name }}</td>
                                    <td>

                                        @if ($trash->image == null)
                                            <img src="{{ Avatar::create($trash->name)->toBase64() }}" alt="">
                                        @else
                                            <img src="{{ asset('uploads/users/' . $trash->image) }}" alt="">
                                        @endif

                                    </td>
                                    <td>{{ $trash->email }}</td>
                                    <td>
                                        <a href="{{ route('trash.restore', $trash->id) }}"
                                            class="btn btn-primary">Restore</a>
                                        <a href="{{ route('trash.delete', $trash->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer_script')
    <script>
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
