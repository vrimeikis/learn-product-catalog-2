@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">User create</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.users.store') }}" method="post">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name">{{ __('Name') }}:</label>
                                <input id="name" class="form-control" type="text" name="name"
                                       value="{{ old('name') }}">
                                @if($errors->has('name'))
                                    <div class="alert-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="last_name">{{ __('Last name') }}:</label>
                                <input id="last_name" class="form-control" type="text" name="last_name"
                                       value="{{ old('last_name') }}">
                                @if($errors->has('last_name'))
                                    <div class="alert-danger">{{ $errors->first('last_name') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('Email') }}:</label>
                                <input id="email" class="form-control" type="text" name="email"
                                       value="{{ old('email') }}">
                                @if($errors->has('email'))
                                    <div class="alert-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Password') }}:</label>
                                <input id="password" class="form-control" type="password" name="password"
                                       value="{{ old('password') }}">
                                @if($errors->has('password'))
                                    <div class="alert-danger">{{ $errors->first('password') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">{{ __('Password confirmation') }}:</label>
                                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation"
                                       value="{{ old('password_confirmation') }}">
                                @if($errors->has('password_confirmation'))
                                    <div class="alert-danger">{{ $errors->first('password_confirmation') }}</div>
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
    </div>
@endsection
