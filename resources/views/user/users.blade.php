@extends('layouts.templates')

@section('content')

<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>isAdmin</th>
              <th>Update</th>
              <th>Delete</th>
              <th>History</th>
              <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->user_id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->is_admin == 1 ? 'Admin' : 'Staff'}}</td>
                <td>
                    <a href="{{action('UserController@edit',$user->user_id)}}" class="btn btn-primary">Edit</a>
                
                <td>
                    <form action="{{action('UserController@destroy', $user->user_id)}}" method="post">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <button class="btn btn-danger" onclick="if (!confirm('Are you sure?')) { return false }" type="submit">Delete</button>           
                    </form>
                </td>
                <td>
                    <a href="{{url('/admin/history',$user->user_id)}}" class = "btn btn-success"> History </a>
                </td>
                 <td>
                    <a href="{{url('/profile', $user->user_id)}}" class = "btn btn-primary"> Detail </a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
    <div class="clearfix">
        {{ $users->links() }}
    </div>
<div>

<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
@endsection