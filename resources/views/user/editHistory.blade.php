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
                <th>Update</th>
                <th>Delete</th>
                <th> Insert
                </th>
            </tr>
        </thead>
        <tbody>
         

            @foreach($times as $time)
                <tr>
                    <td>{{$time->id}}</td>
                    <td>{{$time->name}}</td>
                    <td>{{$time->start}}</td>
                    <td>{{$time->finish}}</td>
                    <td>{{$time->time_per_day}}</td>
                    <td>{{$time->all_time}}</td>
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
                    <td>
                        <a href="{{action('UserController@insertTime', $time->time_id)}}"
                            class="btn btn-primary" > Insert </a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    <div class="clearfix">
        {{ $times->links() }}
    </div>
</div>
@endsection
