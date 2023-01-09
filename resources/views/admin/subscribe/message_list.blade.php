@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Message List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                            </tr>
                            @foreach ($message_lists as $sl => $message_list)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $message_list->name }}</td>
                                    <td>{{ $message_list->email }}</td>
                                    <td>{{ $message_list->subject }}</td>
                                    <td>{{ $message_list->message }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
