@extends('layouts.templates')

@section('content')

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    
                    <form method="get" action="{{action('UserController@history',$user_id)}}">
                    <label> Month : </label>
                    <label>
                        <select name="select" style="width:200px" class="position">                            
                            @foreach($months as $month)
                            <option {{$date == $month->month ? 'selected' : ''}}>
                                {{$month->month}}
                            </option>
                            @endforeach
                        </select>

                    </label>
                    <button type="submit" class="btn btn-primary">Select</button>
                    </form>
                     <span style="color: blue; font-size: 24px">
                        <td>Total time working : </td>
                        <td>{{$allTime}}</td>
                        <br \>
                        <td>Total time leave in month : </td>
                        <td>{{$timeLeave}}</td>
                    </span>
                </div>                
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Start</th>
                <th>Finish</th>
                <th>Today</th>
              
                <th>Date</th>
                <th>Update</th>
                <th>Delete</th>
                <td>
                    <a href="{{action('UserController@insert', $user_id)}}"
                    class="btn btn-primary" > Insert </a>
                </td>

            </tr>
        </thead>
        <tbody>
            
            @foreach($times as $time)
            <tr>
                
                
                <td>{{$time->user_id}}</td>
                <td>{{$time->name}}</td>
                <td>{{$time->start}}</td>
                <td>{{$time->finish}}</td>
                <td>{{$time->time_per_day}}</td>
                
                <td>{{$time->date}}</td>
                <td>
                    <a href="{{action('UserController@editTime',$time->time_id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{action('UserController@deleteTime', $time->time_id)}}" method="post">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <button class="btn btn-danger" onclick="if (!confirm('Are you sure?')) { return false }" type="submit">Delete</button>           
                    </form>
                </td>
                
            </tr>
            @endforeach
        </tbody>

    </table>
   
    <div class="clearfix">
        {{ $times->links() }}
    </div>
</div>

</script>
<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
@endsection
