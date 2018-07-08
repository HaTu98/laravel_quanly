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
    <form method="post" action="{{action('UserController@updateTime', $time_id)}}" >
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">ID: {{$times->id}}</label>
            
        </div>
        <div class="form-group">
            <label for="name">Start: </label>
            <input type="text" class="form-control" name="start" value={{$times->start}} />
        </div>
        <div class="form-group">
            <label for="email">Finish: </label>
            <input type="text" class="form-control" name="finish" value={{$times->finish}} />
        </div>
        <div class="form-group">
            <label for="name">Date: {{$times->date}} </label>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection