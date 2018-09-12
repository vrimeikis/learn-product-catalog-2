@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Manufacturers list
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.manufacturer.create') }}">
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
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Logo</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>

                            @foreach($manufacturers as $manufacturer)
                                <tr>
                                    <td>{{ $manufacturer->id }}</td>
                                    <td>{{ $manufacturer->title }}</td>
                                    <td>{{ $manufacturer->slug }}</td>
                                    <td>{{ $manufacturer->logo }}</td>
                                    <td>{{ $manufacturer->active }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="{{ route('admin.manufacturer.edit', [$manufacturer->id]) }}">
                                            {{ __('Edit') }}
                                        </a>
                                        <a class="btn btn-sm btn-info" href="{{ route('admin.manufacturer.show', [$manufacturer->id]) }}">
                                            {{ __('More info') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                        {{ $manufacturers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
