@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Deposit') }}</div>
                    <form method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="account">Account</label>
                                <select name="account" class="form-control" id="account">
                                    @foreach($accounts as $account)
                                        <option value="{{$account->id}}">{{$account->name}}</option>
                                    @endforeach
                                </select>
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
                            <button type="submit" class="btn btn-primary">Deposit</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
