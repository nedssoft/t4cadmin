@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
               Welcome, {{Auth::user()->name}} 
               
                </div> 
                @if(isset($message)) 
                 <div class="alert alert-info alert-info fade in">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ $message }}
                  </div>
                  @endif
                <div class="panel-body">
              
                   <p><div> <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Add</button><a href="/home" class="btn btn-default">Back Home</a></div></p>

                 <div class="table-responsive">
                  <table class="table">
                    <tr>                   
                    <th>Name</th>
                    <th>Icon</th>
                    <th>description</th>                  
                    <th>Action</th>
                    </tr>
                    

                    <tr>
                    <td>Name</td>
                    <td>Icon</td>
                    <td>Description</td>
                  
                    <td>
                    <a  href='level/delete/'>Delete</a>
                    <a href='level/update/'>Update </a>
                    </td>
                    </tr>
                    
                
                 
                  </table>
                </div> 


                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Badge</h4>
      </div>
      <form action="badge/create" method="POST">
            {{ csrf_field() }}
      <div class="modal-body col-md-12">
        <p>Fields marked with * are required</p>
        
         <p><div class="col-md-6">Name : </div><div class="col-md-6"><input class="form-control" name="name" type="text"></div></p>
         <p><div class="col-md-6">Icon : </div><div class="col-md-6"><input class="form-control" name="phone" type="file"></div></p>
         <p><div class="col-md-6">Description : </div><div class="col-md-6"><textarea class="form-control"></textarea></div></p>
        
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
        <button type="sumit" class="btn btn-default">Add</button>
      </div>
      </form>
    </div>

  </div>
</div>
@endsection
