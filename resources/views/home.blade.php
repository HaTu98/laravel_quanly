@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span style="color: red; font-size: 32px">
                        Dashboard : 
                        @if(session('user.role') == 1)
                            Admin
                        @else
                            Staff
                        @endif
                    </span>

                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(session('user.role') == 1)
                        <div class="row">
                            <a href="{{ route('register') }}" class="btn btn-success">Register</a>
                        </div>

                        <div class="row">
                            <a href="{{url('/admin/user')}}" class="btn btn-info">show all user</a>
                        </div>
                    @endif
                    <div class="row">
                        <a href="{{url('/start')}}"class="btn btn-primary">Start</a>
                    </div>
                    <div class="row">
                       <a href = "{{url('/form')}}"class="btn btn-danger">Form</a>

                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
