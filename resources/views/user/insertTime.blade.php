@extends('layouts.templates')



@section('content')
<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
@endif
    <div class="row">
    <form method="post" action="{{action('UserController@insertTime', $user_id)}}" >
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">ID: {{$user_id}} </label>

            
        </div>
        <div class="form-group">
            <label for="name">Start: </label>
            <input type="text" class="form-control" name="start"/>
        </div>
        <div class="form-group">
            <label for="email">Finish: </label>
            <input type="text" class="form-control" name="finish" />
        </div>
        <div class="form-group">
        	<label for="email">Date: </label>
            <input type="text" class="form-control" name="date" />
        </div>
        <button type="submit" class="btn btn-primary">Insert</button>
    </form>
    </div>
</div>

<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
@endsection