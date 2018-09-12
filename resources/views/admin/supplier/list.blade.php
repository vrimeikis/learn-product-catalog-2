@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Suppliers list
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.suppliers.create') }}">{{ __('New') }}</a>
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
                                <th>Logo</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>

                            @foreach($suppliers as $supplier)
                                <tr>
                                    <td>{{ $supplier->id}}</td>
                                    <td>

                                        @if ($supplier->logo)
                                            <img width="100" src="{{ Storage::url($supplier->logo) }}">
                                        @endif
                                    </td>
                                    <td>{{ $supplier->title }}</td>
                                    <td>{{ $supplier->slug }}</td>
                                    <td>{{ $supplier->active }}</td>

                                    <td>
                                        <a class="btn btn-sm btn-success"
                                           href="{{ route('admin.suppliers.edit', [$supplier->id]) }}">{{ __('Edit') }}
                                        </a>

                                        <a class="btn btn-sm btn-success"
                                           href="{{ route('admin.suppliers.show', [$supplier->id]) }}">{{ __('More info') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                        {{ $suppliers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
