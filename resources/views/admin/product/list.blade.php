@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Products List
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.product.create') }}">{{ __('New') }}</a>

                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (session('error'))

                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>

                        @endif

                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Cover</th>
                                <th>Slug</th>
                                <th>Price</th>
                                <th>Available</th>
                            </tr>

                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>
                                        @if($product->cover)
                                            <img width="100" src="{{ Storage::url($product->cover) }}">

                                        @endif

                                    </td>

                                    <td>{{ $product->slug }}</td>
                                    <td>
                                        {{ $product->price }}
                                    </td>
                                    <td>
                                        @if($product->active >0)
                                            <p style="color: green;">Active</p>
                                            @else
                                            <p style="color: red;">Inactive</p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </table>

                        {{ $products->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
