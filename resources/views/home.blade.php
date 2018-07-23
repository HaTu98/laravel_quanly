@extends('layouts.templates')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <!--
                    <span style="color: red; font-size: 32px">
                        Dashboard : 
                        @if(session('user.role') == 1)
                            Admin
                        @else
                            Staff
                        @endif
                    </span>
                    -->

                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(\Session::has('success'))
                        <div class="alert alert-success">
                            {{\Session::get('success')}}
                        </div>
                    @endif
                    <div class="text-center" style="font-size: 100px">
                        <tr>
                            HeLLO
                        </tr>
                    </div>
                    <!--
                    @if(session('user.role') == 1)
                        <th class="row">
                            <a href="{{ route('register') }}" class="btn btn-success">Register</a>
                        </th>

                        <th class="row">
                            <a href="{{url('/admin/user')}}" class="btn btn-info">show all user</a>
                        </th>
                    @endif
                    <th class="row">
                        <a href="{{url('/start')}}"class="btn btn-primary">Start</a>
                    </th>
                    <th class="row">
                       <a href = "{{url('/form')}}"class="btn btn-danger">Form</a>

                    </th>
                    -->
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
@endsection
