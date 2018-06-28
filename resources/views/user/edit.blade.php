@extends('layouts.app')

@section('content')
<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
@endif
    <div class="row">
    <form method="post" action="{{action('UserController@update', $id)}}" >
        {{csrf_field()}}
        
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value={{$user->name}} />
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" name="email" value={{$user->email}} />
        </div>
        <div class="form-group">
            <label for="isAdmin">isAdmin:</label>
            <input type="text" class="form-control" name="isAdmin" value={{$user->isAdmin}} />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection