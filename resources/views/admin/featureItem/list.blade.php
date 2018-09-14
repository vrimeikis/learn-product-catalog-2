@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Feature Items list
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.featuresItems.create') }}">{{ __('New') }}</a>
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

                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->id}}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td>{{ $item->active }}</td>

                                    <td>
                                        <a class="btn btn-sm btn-success"
                                           href="{{ route('admin.featuresItems.edit', [$item->id]) }}">{{ __('Edit') }}</a>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
