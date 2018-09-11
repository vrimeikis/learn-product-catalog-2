@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Categories list
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.categories.create') }}">{{ __('New') }}</a>
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
                                <th>Updated at</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Active</th>
                                <th>Cover</th>
                                <th>Actions</th>
                            </tr>

                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id}}</td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>{{ $category->updated_at }}</td>
                                    <td>{{ $category->title }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->active }}</td>
                                    <td>
                                        {{ $category->cover }}
                                        @if ($category->cover)
                                            <img width="100" src="{{ Storage::url($category->cover) }}">
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-success"
                                           href="{{ route('admin.categories.edit', [$category->id]) }}">{{ __('Edit') }}</a>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
