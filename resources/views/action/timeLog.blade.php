@extends('layouts.templates')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span style="color: red; font-size: 32px">
                        Admin Action
                    </span>

                </div>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
              <th>Name Admin</th>
              <th>User Name</th>
              <th>Action type</th>
              <th>Before</th>
              <th>After</th>
              <th>Time</th>
             
            </tr>
        </thead>
        <tbody>
         @foreach($times_log as $time_log)
            <tr>
                <td>{{$time_log->name}}</td>
                <td>{{$time_log->name_update}}</td>
                <td>{{$time_log->action_type}}</td>
                <td>{{$time_log->before_action}}</td>
                <td>{{$time_log->after_action}}</td>
                <td>{{$time_log->created_at}}</td>
            </tr>
         @endforeach
        </tbody>

    </table>
    <div>
        <a href = "" onclick="if (!confirm('Download file?')) { return false }" class="btn btn-success">print</a>
    </div>
    <div class="clearfix">
       {{ $times_log->links() }}
    
    </div>
</div>
@endsection
       