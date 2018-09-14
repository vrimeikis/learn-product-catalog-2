@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Supplier Show: {{ $supplier->title }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <tr>
                                <td>{{ __('Title') }}:</td>
                                <td>{{ $supplier->title }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Slug') }}:</td>
                                <td>{{ $supplier->slug }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Logo') }}</td>
                                <td>
                                    @if ($supplier->logo)
                                        <br>
                                        <img width="300" src="{{ Storage::url($supplier->logo) }}">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('Description') }}:</td>
                                <td>{{ $supplier->description }}</td>
                            </tr>

                            <tr>
                                <td>{{ __('Address') }}:</td>
                                <td>{{ $supplier->address }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Email') }}:</td>
                                <td>{{ $supplier->email }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Phone') }}:</td>
                                <td>{{ $supplier->phone }}</td>
                            </tr>
                            <td>
                                @if($supplier->active >0)
                                    <p style="color: green;">Active</p>
                                @else
                                    <p style="color: red;">Inactive</p>
                                @endif
                            </td>
                        </table>

                        <a class="btn btn-secondary" href="javascript:history.back();">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection