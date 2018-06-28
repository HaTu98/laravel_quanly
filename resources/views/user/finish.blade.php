@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span style="color: red; font-size: 32px">
                        Time Working
                    </span>

                </div>

                <div class="card-body">
                    
                    <div class="row">
                        <a href="{{action('UserController@finish')}}" class="btn btn-danger">Checkout</a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
