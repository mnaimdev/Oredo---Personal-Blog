@extends('layouts.dashboard')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Permissions</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('edit.permission') }}" method="post">
                            @csrf
                            <div class="form-group">

                                <div class="form-control p-2 ">
                                    <input type="hidden" name="user_id" value="{{ $users->id }}">

                                    <span>{{ $users->name }}</span>
                                    @foreach ($users->getRoleNames() as $role)
                                        <span class="float-right badge badge-primary">{{ $role }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <h3>Permissions</h3>
                                @foreach ($permissions as $permission)
                                    <div>
                                        <input {{ $users->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                            type="checkbox" name="permission[]" value="{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
