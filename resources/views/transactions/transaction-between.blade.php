@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Between account transaction') }}</div>
                    <form method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="account">Account</label>
                                <select name="account" class="form-control" id="account">
                                    @foreach($accounts as $account)
                                        <option value="{{$account->id}}">{{$account->name . ' ' . $account->currency}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="count">Count</label>
                                <input type="text" id="count" class="form-control" name="count" value="0">
                            </div>

                            <div class="form-group">
                                <label for="account2">Account</label>
                                <select name="account2" class="form-control" id="account2">
                                    @foreach($accounts as $account)
                                        <option value="{{$account->id}}">{{$account->name . ' ' . $account->currency}}</option>
                                    @endforeach
                                </select>
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
