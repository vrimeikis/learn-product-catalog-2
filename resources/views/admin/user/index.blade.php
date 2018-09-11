@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">User information</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Last name</th>
                                <th>Email</th>
                                <th>Registration date</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>

                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    @foreach($user->addresses as $address)
                                        {{ $address->address }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-success"
                                       href="{{ route('admin.user.address.create', [$user->id]) }}">
                                        {{ __('Add address') }}
                                    </a>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
