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

                        <form action="{{ route('admin.product.update', [$product->id]) }}" method="post" enctype="multipart/form-data">

                            {{ method_field('put') }}

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="title">{{ __('Title') }}:</label>
                                <input id="title" class="form-control" type="text" name="title"
                                       value="{{ old('title', $product->title) }}">
                                @if($errors->has('title'))
                                    <div class="alert-danger">{{ $errors->first('title') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="cover">{{ __('Cover') }}</label>
                                @if($product->cover)
                                    <img width="200" src="{{ Storage::url($product->cover) }}" alt="">
                                @endif
                                <input type="file" id="cover" class="form-control" name="cover" accept=".jpg, .jpeg, .png">
                            </div>

{{--                            {{ print_r($errors) }}--}}

                            @if($errors->has('cover'))
                                <div class="alert-danger">{{ $errors->first('cover') }}</div>
                            @endif

                            <div class="form-group">
                                <label for="context">{{ __('Context') }}:</label>
                                <textarea id="context" class="form-control"
                                          name="context">{{ old('context', $product->context) }}</textarea>
                                @if($errors->has('context'))
                                    <div class="alert-danger">{{ $errors->first('context') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="price">{{ __('Price') }}:</label>
                                <input id="price" class="form-control" type="number" name="price"
                                       value="{{ old('price', $product->price) }}">
                                @if($errors->has('price'))
                                    <div class="alert-danger">{{ $errors->first('price') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="active">{{ __('Active') }}:</label>
                                <input type="checkbox" name="active"
                                        {{ (old('active', $product->active) ? 'checked' : '') }}
                                ><br>
                                @if($errors->has('active'))
                                    <div class="alert-danger">{{ $errors->first('active') }}</div>
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
