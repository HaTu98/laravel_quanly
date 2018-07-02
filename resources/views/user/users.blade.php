@extends('layouts.app')

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
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->isAdmin}}</td>
                <td>
                    <a href="{{action('UserController@edit',$user->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{action('UserController@destroy', $user->id)}}" method="post">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
                <td>
                    <a href="{{url('/admin/history',$user->id)}}" class = "btn btn-success"> History </a>
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