@extends('layouts.dashboard')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </nav>
    <div class="row">
        @can('show_user_list')
            <div class="col-lg-12">
                <form action="{{ route('delete.check') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3>Users List <span class="float-right">Total: {{ $total_user }}</span></h3>
                            <button type="submit" class="btn btn-danger">Delete Check</button>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">

                                <tr>
                                    <th><input type="checkbox" id="checkAll"> Check All</th>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($users as $sl => $user)
                                    <tr>
                                        <td><input type="checkbox" name="check[]" value="{{ $user->id }}"></td>
                                        <td>{{ $sl + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @can('delete_user')
                                                <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger">Delete</a>
                                            @else
                                                <span>You can't see this</span>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="py-3">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endcan
    </div>
@endsection

@section('footer_script')
    <script>
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
