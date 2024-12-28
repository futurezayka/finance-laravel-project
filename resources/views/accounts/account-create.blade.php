@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Account create') }}</div>
                    <form method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                                @error('name')
                                <div class="alert-danger" style="color: red">Name must be unique</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="currency">Currency</label>
                                <select name="currency" class="form-control" id="currency">
                                    <option value="UAH">UAH</option>
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="count">Count</label>
                                <input type="text" id="count" class="form-control" name="count" value="0">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
