@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Users list
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.users.create') }}">
                            {{ __('New') }}
                        </a>
                    </div>

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
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>

                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="{{ route('admin.users.edit', [$user->id]) }}">
                                            {{ __('Edit') }}
                                        </a>
                                        <a class="btn btn-sm btn-info" href="{{ route('admin.users.show', [$user->id]) }}">
                                            {{ __('More info') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
