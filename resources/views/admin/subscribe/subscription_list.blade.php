@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Subscription List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>Email</th>
                            </tr>
                            @foreach ($subsciption_lists as $sl => $subsciption_list)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $subsciption_list->email }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
