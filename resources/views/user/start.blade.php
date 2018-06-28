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

                    @if(session('user.role') == 1)
                        <div class="row">
                            <a href="" class="btn btn-info">show all time</a>
                        </div>
                    @endif

                    <div class="row">
                        <a href = "{{action('UserController@finish')}}"class="btn btn-danger">Checkin</a>
                    </div>
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
                    <td>{{$time->id}}</td>
                    <td>{{Auth::user()->name}}</td>
                    <td>{{$time->start}}</td>
                    <td>{{$time->finish}}</td>
                    <td>{{$time->time_per_day}}</td>
                    <td>{{$time->all_time}}</td>
                    <td>{{$time->date}}</td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection
