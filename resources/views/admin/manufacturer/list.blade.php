@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Manufacturers list
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.manufacturers.create') }}">
                            {{ __('New') }}
                        </a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if($manufacturers->IsNotEmpty())
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Logo</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>

                            @foreach($manufacturers as $manufacturer)
                                <tr>
                                    <td>{{ $manufacturer->id }}</td>
                                    <td>
                                        @if ($manufacturer->logo)
                                            <img src="{{ Storage::url($manufacturer->logo) }}" height="30">
                                        @endif
                                    </td>
                                    <td>{{ $manufacturer->title }}</td>
                                    <td>{{ $manufacturer->slug }}</td>
                                    <td>{{ ($manufacturer->active)? 'Active': 'Inactive' }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="{{ route('admin.manufacturers.edit', [$manufacturer->id]) }}">
                                            {{ __('Edit') }}
                                        </a>
                                        <a class="btn btn-sm btn-info" href="{{ route('admin.manufacturers.show', [$manufacturer->id]) }}">
                                            {{ __('More info') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                        {{ $manufacturers->links() }}
                        @else
                            No manufactures yet!
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
