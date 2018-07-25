@extends('layouts.templates')

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
   
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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
    </div>
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
    <form method="post" action="{{action('UserController@updateTime', $time_id)}}" >
        <hr class="colorgraph">
        <div class="panel panel-info">
            {{csrf_field()}}
            <div class="panel-heading">
                <div class="row">
                    <h3 class="panel-title col-xs-12 col-sm-6 col-md-6"> User ID : {{$times->user_id}} </h3>
                    <h3 class="panel-title col-xs-12 col-sm-6 col-md-6">Date: {{$times->date}}</h3>
                </div>
            </div>
            <div class="panel-body">
            <div class="form-group" >
                <label >Start : </label>
                <input type="text" id="timepicker" required autofocus width="276" class="form-control" name="start" value={{$times->start}} />
            </div>
            <div class="form-group">
                <label >Finish: </label>
                <input type="text" id="timepicker1" required autofocus width="276" class="form-control" name="finish" value={{$times->finish}} />
            </div>
            <div class="form-group">
                <label ></label>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>

            </div>
        </div>
        </form>
    </div>
</div>

<script>
    $('#timepicker').timepicker({
        uiLibrary: 'bootstrap4',
        
    });
</script>

<script>
    $('#timepicker1').timepicker({
        uiLibrary: 'bootstrap4',
        
    });
</script>

<style type="text/css">
    .gj-timepicker-bootstrap [role=right-icon] button .gj-icon, .gj-timepicker-bootstrap [role=right-icon] button .material-icons {
    position: unset;
    font-size: 21px;
    top: 7px;
    left: 9px;
}
</style>
<!-- jQuery 3 -->

<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
@endsection