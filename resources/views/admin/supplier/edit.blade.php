@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Supplier's Edit
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.supplier.update', [$supplier->id]) }}" method="post" enctype="multipart/form-data">

                            {{ method_field('put') }}

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="title">{{ __('Title') }}:</label>
                                <input id="title" class="form-control" type="text" name="title"
                                       value="{{ old('title', $category->title) }}">
                                @if($errors->has('title'))
                                    <div class="alert-danger">{{ $errors->first('title') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="active">{{ __('Active') }}:</label>

                                <select id="active" name="active" class="form-control">
                                    <option value="1">True</option>
                                    <option value="0">False</option>
                                </select>

                                @if($errors->has('active'))
                                    <div class="alert-danger">{{ $errors->first('active') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="logo">{{ __('Logo') }}</label>
                                <input id="logo" class="form-control" type="file" name="logo" accept=".jpg, .jpeg, .png">
                                @if($errors->has('logo'))
                                    <div class="alert-danger">{{ $errors->first('logo') }}</div>
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
