@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Your Accounts') }}
                </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Currency</th>
                                    <th>Count</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($accounts as $account)
                                    <tr>
                                        <td>{{$account->name}}</td>
                                        <td>{{$account->currency}}</td>
                                        <td>{{$account->count}}</td>
                                        <td>
                                            <a href="{{route('account-edit', $account->id)}}">
                                                <button type="button"  class="btn btn-primary">
                                                    Edit
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-inline-block">
                            <a href="{{route('account-create')}}">
                                <button type="button" class="btn btn-primary">
                                    Add account
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
