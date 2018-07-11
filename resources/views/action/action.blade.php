@extends('layouts.app')



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
              <th>Action</th>
              <th>Time</th>
             
            </tr>
        </thead>
        <tbody>
         

           

        </tbody>

    </table>
    <div>
        <a href = "" onclick="if (!confirm('Download file?')) { return false }" class="btn btn-success">print</a>
    </div>
    <div class="clearfix">
       
    </div>
</div>
@endsection
