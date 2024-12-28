@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update profile') }}</div>
                    <form method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{$data->name}}">
                            </div>
                            <div class="form-group">
                                <label for="surname">Name</label>
                                <input type="text" id="surname" class="form-control" name="surname" value="{{$data->surname}}">
                            </div>
                            <div class="form-group">
                                <label for="currency">Default currency</label>
                                <select name="currency" class="form-control" id="currency">
                                    <option value="UAH">UAH</option>
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                </select>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Deposit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
