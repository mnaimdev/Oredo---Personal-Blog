@extends('layouts.dashboard')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h3>Role List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>Role</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($roles as $sl => $role)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @foreach ($role->getAllPermissions() as $permission)
                                            <span class="badge badge-primary">{{ $permission->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h3>Role List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>User</th>
                                <th>Role</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($users as $sl => $user)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    {{-- <td>
                                        @forelse ($user->getRoleNames() as $role)
                                            <span class="badge badge-success">{{ $role }}</span>
                                        @empty
                                            <span class="badge badge-secondary">Not Assigned</span>
                                        @endforelse
                                    </td> --}}
                                    {{-- <td>
                                        @forelse ($user->getAllPermissions() as $permission)
                                            <span class="badge badge-info">{{ $permission->name }}</span>
                                        @empty
                                            <span class="badge badge-secondary">Not Assigned</span>
                                        @endforelse
                                    </td> --}}
                                    <td>
                                        <a href="{{ route('edit.user.role', $user->id) }}" class="btn btn-primary">Edit</a>

                                        <a href="{{ route('delete.user.role', $user->id) }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-lg-3">

                {{-- <div class="card">
                    <div class="card-header">
                        <h3>Add Permission</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('permission.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="permission_name">
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div> --}}

                <div class="card">
                    <div class="card-header">
                        <h3>Add Role</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('role.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="role_name">
                            </div>
                            <div class="form-group">
                                <h3>Permissions</h3>
                                @foreach ($permissions as $permission)
                                    <div>
                                        <input type="checkbox" name="permission[]" value="{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h3>Assign Role</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('assign.role') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <select name="user_id" class="user">
                                    <option>-- Select User --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="role_id">
                                    <option>-- Select Role --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">
                                    Submit
                                </button>
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
            $('.user').select2();
        })
    </script>
@endsection
