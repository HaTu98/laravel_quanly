@extends('layouts.templates')

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title></title>
   
  <!-- Scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

  <!-- Fonts -->
  
  <!-- Styles -->
   
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" /> 



  <style type="text/css">
    .dropdown-toggle:after {
      content: unset !important;
    } 
  </style>


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

  

<main class="py-4">
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
              <form method="post" action="{{action('ProfileController@updateProfile', $profile->user_id)}}" enctype="multipart/form-data"> 
                {{csrf_field()}}
                <div class="col-md-9 col-lg-9 " align="center"> 
                  <img alt="User Pic"   src={{url("img/" . $profile->user_id . ".jpg")}} width="100" height="70" class="img-circle img-responsive"> 
                  <input type="file" name="img" id = "img">
                </div>
                
                
                <div class=" col-md-20 col-lg-20 " > 
                  
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>First Name :</td>
                        <td>
                          <input type="text" class="form-control" name="first_name" value="{{$profile->first_name}}" />
                        </td>
                      </tr>
                      <tr>
                        <td>Last Name :</td>
                        <td>
                          <input type="text" class="form-control" name="last_name" value="{{$profile->last_name}}" />
                        </td>
                      </tr>
                      <tr>
                        <td>Date of Birth :</td>
                        <td>
                          <input type="text" class="form-control" name="date_of_birth" value="{{$profile->date_of_birth}}" />
                        </td>
                      </tr>
                      <tr>
                        <tr>
                          <td>Gender :</td>
                          <td>
                            <input type="text" class="form-control" name="gender" value="{{$profile->gender}}" />
                          </td>
                        </tr>
                        <tr>
                          <td>Position :</td>
                          <td>
                         
                            <label>
                              <select id="Example" name="position[]" class="position" multiple="true">

                                @foreach($positions as $position)
                                  <?php  
                                    $check = 0;
                                    foreach($user_positions as $user_position){
                                      if($position->position_id == $user_position->position_id) 
                                        $check = 1;
                                    }
                                  ?>
                                  

                                  <option  {{ $check == 1  ? 'selected' : ''}} value="{{$position->position_id}}">{{$position->position_name}}</option>
                                
                                @endforeach

                              </select>

                            </label>
                          </td> 
                        </tr>
                        <tr>
                          <td>Home Address :</td>
                          <td>
                            <input type="text" class="form-control" name="home_address" value="{{$profile->first()->home_address}}" />
                          </td>
                        </tr>
                        <tr>
                          <td>Email :</td>
                          <td>
                            <input type="text" class="form-control" name="email" value="{{$profile->email}}" />

                          </td>
                        </tr>
                        <td>Phone Number :</td>
                        <td>
                          <input type="text" class="form-control" name="phone_number" value="{{$profile->first()->phone_number}}" />
                        </td>
                        
                      </tr>
                    </tbody>

                  </table>
                  
                    <button type="submit" style="margin-left: 100px"  class="btn btn-primary">Update</button>
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <script>
      $(document).ready(function(){
       $('#Example').multiselect({
        nonSelectedText: 'Select Position',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth:'400px',
      });
     });
   </script>   
 </main>
@endsection
