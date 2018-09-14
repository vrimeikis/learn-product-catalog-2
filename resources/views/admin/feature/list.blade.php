@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Features list
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.features.create') }}">{{ __('New') }}</a>
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
                                <th>Created at</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>

                            @foreach($features as $feature)
                                <tr>
                                    <td>{{ $feature->id}}</td>
                                    <td>{{ $feature->created_at }}</td>
                                    <td>{{ $feature->title }}</td>
                                    <td>{{ $feature->slug }}</td>
                                    <td>{{ $feature->active }}</td>

                                    <td>
                                        <a class="btn btn-sm btn-success"
                                           href="{{ route('admin.features.edit', [$feature->id]) }}">{{ __('Edit') }}</a>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                        {{ $features->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
