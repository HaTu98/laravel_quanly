<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Welcome</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{{ asset('dist/css/skins/skin-blue.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style type="text/css">
  .user-panel>.image>img {
    width: 100%;
    max-width: 45px;
    height: 45px;
    max-height: 45px;
}
</style>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="/home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Db</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Dashbroad</b> </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
          
          <!-- Tasks Menu -->
          
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-right: 100px">
              <!-- The user image in the navbar-->
              <img src={{url("img/" . Auth::user()->user_id . ".jpg")}} class="user-image" alt="User Image">

              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              
              <span class="hidden-xs">{{Auth::user()->userProfiles->first_name}} {{Auth::user()->userProfiles->last_name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src={{url("img/" . Auth::user()->user_id . ".jpg")}} class="img-circle" alt="User Image">

                <p>
                  {{Auth::user()->userProfiles->first_name}} {{Auth::user()->userProfiles->last_name}}
                  
                  <small>
                   
                  </small>
                </p>
              </li>
              <!-- Menu Body --
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                -- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{url('/profile', Auth::User()->user_id)}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                   <a  class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                    </a>
                              
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src={{url("img/" . Auth::user()->user_id . ".jpg")}}  class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> {{Auth::user()->userProfiles->first_name}} {{Auth::user()->userProfiles->last_name}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"></li>
        <!-- Optionally, you can add icons to the lin{{ route('register') }}s -->
        @if(session('user.role') == 1)
          <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Show ALL Users</span>
             <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>s
            </a>
            <ul class="treeview-menu">
              <li ><a href="{{url('/admin/users')}}"><i ></i> <span>All Users</span></a></li>
              <li ><a href="{{url('/admin/usersHasDeleted')}}"><i ></i> <span>Users Has Deleted</span></a></li>
            </ul>
          </li>  
        	
        	<li><a href="{{ route('register') }}"><i class="fa fa-link"></i> <span>Register</span></a></li>
        	

        	<li class="treeview">
          		<a href="#"><i class="fa fa-link"></i> <span>Action Log</span>
            	 <span class="pull-right-container">
                	<i class="fa fa-angle-left pull-right"></i>
              	</span>
          		</a>
          		<ul class="treeview-menu">
            		<li><a href="{{ url('/admin/userLog')}}"> <span>User Log</span></a></li>
            		<li><a href="{{ url('/admin/timeLog')}}"> <span>Time Log</span></a></li>
            		<li><a href="{{ url('/admin/profileLog')}}"> <span>Profile Log</span></a></li>
          		</ul>
        	</li>

        @endif
        <li><a href="{{ url('/start')}}"><i class="fa fa-link"></i> <span>Checkin</span></a></li>
        <li><a href="{{ url('/form') }}"><i class="fa fa-link"></i> <span>Times</span></a></li>
       
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!---------------------------------------
    <section class="content-header">
      <h1>
        Page Header
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>
    ------------------------------------------->

    <!-- Main content -->
    <section class="content container-fluid">
     
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->

<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>