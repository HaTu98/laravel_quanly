@extends('layouts.templates')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <form method="get" action="{{action('UserController@form')}}">
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
                    <br \>
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
              <th>Total</th>
              <th>Date</th>
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
                    <td>{{$time->all_time}}</td>
                    <td>{{$time->date}}</td>
                </tr>
            @endforeach

        </tbody>

    </table>
    <div>
        <a href = "{{action('UserController@print')}}" onclick="if (!confirm('Download file?')) { return false }" class="btn btn-success">print</a>
    </div>
    <div class="clearfix">
        {{ $times->links() }}
    </div>
</div>

<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
@endsection
