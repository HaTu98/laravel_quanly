@extends('layouts.app')


<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
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
<p class=" text-info"> </p>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">{{$profile->first_name}} {{$profile->last_name}}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic"  src="http://i.9mobi.vn/cf/images/2015/03/nkk/nhung-hinh-anh-dep-4.jpg" width="100" height="70" class="img-circle img-responsive"> </div>

                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>First Name :</td>
                        <td>{{$profile->first_name}}</td>
                      </tr>
                      <tr>
                        <td>Lasr Name :</td>
                        <td>{{$profile->last_name}}</td>
                      </tr>
                      <tr>
                        <td>Date of Birth :</td>
                        <td>{{$profile->date_of_birth}}</td>
                      </tr>
                      <tr>
                        
                      	<tr>
                          <td>Gender :</td>
                          <td>{{$profile->gender}}</td>
                      	</tr>
                      	<tr>
                          <td>Position :</td>
                          <td>{{$profile->position}}</td>
                      	</tr>
                      	<tr>
                        	<td>Home Address :</td>
                        	<td>{{$profile->home_address}}</td>
                      	</tr>
                      	<tr>
                        	<td>Email :</td>
                        	<td>{{$profile->email}}</td>
                      	</tr>
                        	<td>Phone Number :</td>
                        	<td>{{$profile->phone_number}}</td>
                           
                      </tr>
                    </tbody>

                  </table>
                  <a href="{{url('/editProfile')}}" class="btn btn-primary"> Edit</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection