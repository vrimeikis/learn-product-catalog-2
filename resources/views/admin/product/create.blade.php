@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Product New
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="title">{{ __('Title') }}:</label>
                                <input id="title" class="form-control" type="text" name="title"
                                       value="{{ old('title') }}">
                                @if($errors->has('title'))
                                    <div class="alert-danger">{{ $errors->first('title') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="cover">{{ __('Cover') }}</label>
                                <input type="file" id="cover" class="form-control" name="cover" accept=".jpg, .jpeg, .png">
                            </div>
                            @if($errors->has('cover'))
                                <div class="alert-danger">{{ $errors->first('cover') }}</div>
                            @endif

                            <div class="form-group">
                                <label for="context">{{ __('Context') }}:</label>
                                <textarea id="context" class="form-control"
                                          name="context">{{ old('context') }}</textarea>
                                @if($errors->has('context'))
                                    <div class="alert-danger">{{ $errors->first('context') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="price">{{ __('Price') }}:</label>
                                <input id="price" class="form-control" type="number" name="price"
                                       value="{{ old('price') }}">
                                @if($errors->has('price'))
                                    <div class="alert-danger">{{ $errors->first('price') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <input class="btn btn-success" type="submit" value="{{ __('Save') }}">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
