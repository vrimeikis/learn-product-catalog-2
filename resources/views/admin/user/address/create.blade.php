@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Add address</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.user.address.store', [$userId]) }}" method="post">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="address">{{ __('Address') }}:</label>
                                <input id="address" class="form-control" type="text" name="address"
                                       value="{{ old('address') }}">
                                @if($errors->has('address'))
                                    <div class="alert-danger">{{ $errors->first('address') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <input class="btn btn-sm btn-success" type="submit" value="{{ __('Save') }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
