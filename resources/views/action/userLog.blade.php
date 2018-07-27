@extends('layouts.templates')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span style="color: red; font-size: 32px">
                        User Log
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
         @foreach($users_log as $user_log)
            <tr>
                <td>{{$user_log->name}}</td>
                <td>{{$user_log->name_update}}</td>
                <td>{{$user_log->action_type == 0 ? 'Delete': 'Update'}}</td>
                <td>{{$user_log->before_action}}</td>
                <td>{{$user_log->after_action}}</td>
                <td>{{$user_log->created_at}}</td>
            </tr>
         @endforeach
        </tbody>

    </table>
    
    <div class="clearfix">
        {{ $users_log->links() }}
    
    </div>
</div>
<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
@endsection
       