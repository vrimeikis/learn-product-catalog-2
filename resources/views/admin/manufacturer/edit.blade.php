@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Manufacturer create</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.manufacturers.update', [$manufacturer->id]) }}" method="post" enctype="multipart/form-data">

                            {{ csrf_field() }}
                            @method('put')

                            <div class="form-group">
                                <label for="logo">{{ __('Logo') }}</label>
                                @if($manufacturer->logo)
                                    <img src="{{ Storage::url($manufacturer->logo) }}" height="100">
                                @endif
                                <input id="logo" class="form-control" type="file" name="logo" accept=".jpg, .jpeg">
                                @if($errors->has('logo'))
                                    <div class="alert-danger">{{ $errors->first('logo') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="title">{{ __('Title') }}:*</label>
                                <input id="title" class="form-control" type="text" name="title"
                                       value="{{ old('title', $manufacturer->title) }}">
                                @if($errors->has('title'))
                                    <div class="alert-danger">{{ $errors->first('title') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="slug">{{ __('Slug') }}:</label>
                                <input id="slug" class="form-control" type="text" name="slug"
                                       value="{{ old('slug', $manufacturer->slug) }}">
                                @if($errors->has('slug'))
                                    <div class="alert-danger">{{ $errors->first('slug') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="description">{{ __('Description') }}:</label>
                                <input id="description" class="form-control" type="text" name="description"
                                       value="{{ old('description', $manufacturer->description) }}">
                                @if($errors->has('description'))
                                    <div class="alert-danger">{{ $errors->first('description') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="address">{{ __('Address') }}:</label>
                                <input id="address" class="form-control" type="text" name="address"
                                       value="{{ old('address', $manufacturer->address) }}">
                                @if($errors->has('address'))
                                    <div class="alert-danger">{{ $errors->first('address') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('Email') }}:</label>
                                <input id="email" class="form-control" type="text" name="email"
                                       value="{{ old('email', $manufacturer->email) }}">
                                @if($errors->has('email'))
                                    <div class="alert-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="phone">{{ __('Phone') }}:</label>
                                <input id="phone" class="form-control" type="text" name="phone" placeholder="+37098765432"
                                       value="{{ old('phone', $manufacturer->phone) }}">
                                @if($errors->has('phone'))
                                    <div class="alert-danger">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="active">
                                    <label>{{ __('Active') }}: </label>
                                    <input type="checkbox" name="active" id="active" {{ (old('active', $manufacturer->active)? 'checked' : '') }}>
                                </label>
                                @if($errors->has('active'))
                                    <div class="alert-danger">{{ $errors->first('active') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>* - required fields</label>
                            </div>

                            <div class="form-group">
                                <input class="btn btn-sm btn-success" type="submit" value="{{ __('Save') }}">
                                <a class="btn btn-sm btn-danger pull-right" href="{{ route('admin.manufacturers.index') }}" >{{ __('Cancel') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
