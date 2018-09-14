@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Manufacturer View: {{ $manufacturer->title }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <tr>
                                <td>{{ __('ID') }}</td>
                                <td>{{ $manufacturer->id }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Logo') }}</td>
                                <td>
                                    @if ($manufacturer->logo)
                                        <img src="{{ Storage::url($manufacturer->logo) }}" height="100">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('Title') }}</td>
                                <td>{{ $manufacturer->title }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Slug') }}</td>
                                <td>{{ $manufacturer->slug }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Description') }}</td>
                                <td>{{ $manufacturer->description }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Address') }}</td>
                                <td>{{ $manufacturer->address }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Email') }}</td>
                                <td>{{ $manufacturer->email }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Phone') }}</td>
                                <td>{{ $manufacturer->phone }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Active') }}</td>
                                <td>{{ $manufacturer->active? 'Active' : 'Inactive' }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Created at') }}</td>
                                <td>{{ $manufacturer->created_at }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Updated at') }}</td>
                                <td>{{ $manufacturer->updated_at }}</td>
                            </tr>
                        </table>
                        <a class='btn btn-sm btn-secondary' href={{ route('admin.manufacturers.index') }}>Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection