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
                <td>{{$user->isAdmin}}</td>
                <td>
                    <a href="{{action('UserController@edit',$user->user_id)}}" class="btn btn-primary">Edit</a>
                </td>
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
@endsection