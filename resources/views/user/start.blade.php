@extends('layouts.templates')

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
                        @if($status == 1)
                            <a href = "{{action('UserController@checkout')}}" onclick="if (!confirm('Are you sure?')) { return false }"class="btn btn-danger">Checkout</a>                  
                        @else
                             <a href = "{{action('UserController@finish')}}" onclick="if (!confirm('Are you sure?')) { return false }"  class="btn btn-danger">Checkin</a>
                        @endif
                        

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
