@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Account edit') }}</div>
                    <form method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$account->name}}">
                                @error('name')
                                <div class="alert-danger" style="color: red">Name must be unique</div>
                                @enderror
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
