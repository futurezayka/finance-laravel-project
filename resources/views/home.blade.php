@extends('layouts.app')

@section('content')
    <div class="container" style="width: 20%">
    <div class="card">
        <div class="card-header">
            Rates
        </div>
        <div class="card-body">
            <table class="table">
                <tbody>
                    @foreach($rates as $rate)
                        <tr>
                            <td>1{{$rate['ccy']}}</td>
                            <td>-</td>
                            <td>{{$rate['sale']}}UAH</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>>
@endsection
