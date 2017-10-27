@extends('layouts.app')

@section('content')

<div class="container">

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
       @if (session()->has('message'))
        <div class="alert alert-info alert-info fade in">
        <a href="/questions" class="close" data-dismiss="alert" aria-label="close">&times;</a>
       {{ session('message')}}
      </div>
        @endif
         @if (session()->has('status'))
        <div class="alert alert-info alert-info fade in">
        <a href="/questions" class="close" data-dismiss="alert" aria-label="close">&times;</a>
       {{ session('status')}}
      </div>
        @endif
      <div class="panel panel-default">
        <div class="panel-heading">
         Welcome To Questions Board, {{Auth::user()->name}} 
   
       </div> 

       @isset ($message) 
       <div class="alert alert-info alert-info fade in">
        <a href="/questions" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ $message }}
      </div>
      @endisset

      <div class="panel-body">

       <p><div> <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Add</button><a href="/home" class="btn btn-default">Back Home</a></div></p>

       <div class="table-responsive">
        <table class="table">
          <tr>                   
            <th>ID</th>
            <th>Question</th>
            <th>Option 1</th>                  
            <th>Option 2</th>
            <th>Option 3</th>
            <th>Option 4</th>
            <th>Answer</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          @isset($questions)
          @foreach ($questions as $q)
          <tr>
            <td>{{ $q->id}}</td>
            <td>{{$q->question}}</td>
            <td>{{$q->option_1}}</td>
            <td>{{$q->option_2}}</td>
            <td>{{$q->option_3}}</td>
            <td>{{$q->option_4}}</td>
            <td>{{$q->answer}}</td>
            <td><i class="{{ $q->status ==2 ? "fa fa-check-circle-o" :""}}" ></i>
                {{$q->status < 2 ? $q->status : ''}}
            </td>
            <td>
              <a  href='/questions/delete/{{$q->id}}'><span class="fa fa-trash-o"></span></a>
              <a href='questions/{{$q->id}}/edit'><span class="fa fa-edit"></span></a>
              <a href='questions/{{$q->id}}/approve'><i class="fa fa-check-square" aria-hidden="true"></i></a>
            </td>
          </tr>
          @endforeach
          @endisset   




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
        <h4 class="modal-title">Add Question</h4>
      </div>

      <form class="form-horizontal" method="POST" action="/questions" enctype="multipart/form-data">
        {{ csrf_field() }}

        @isset ($message)
        <div class="alert alert-success">{{ $message }}</div>  
        @endisset

        <div class="form-group">

          <div class="col-md-6 col-md-offset-4">
            <select class="form-control" id="category" name="category_id">
              <option>Choose category</option>
              @isset($categories)
              @foreach ($categories as $cat)
              <option value="{{$cat->cid}}">{{$cat->name}}</option> 
              @endforeach
              @endisset
            </select>
          </div>
        </div>

        <div class="form-group">

          <div class="col-md-6 col-md-offset-4">
            <select class="form-control" id="level" name="level_id">
             <option>Choose Level</option>
             @isset($levels)
             @foreach ($levels as $level)
             <option value="{{$level->id}}">{{$level->name}}</option> 
             @endforeach

             @endisset  
           </select>
         </div>
       </div>
       <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
        <label for="question" class="col-md-4 control-label"><span style="color: #18BC9C;" ></span></label>

        <div class="col-md-6">
          <textarea id="question" type="text" rows="6" class="form-control" name="question" value="{{ old('question') }}"
          placeholder="Type the question here "  ></textarea>

          @if ($errors->has('question'))
          <span class="help-block">
            <strong>{{ $errors->first('question') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('option_1') ? ' has-error' : '' }}">
        <label for="option_1" class="col-md-4 control-label"><span style="color:#18BC9C;" ></span></label>

        <div class="col-md-6">
          <input id="option_1" type="text" class="form-control" name="option_1" placeholder="Enter option_1">

          @if ($errors->has('option_1'))
          <span class="help-block">
            <strong>{{ $errors->first('option_1') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('option_2') ? ' has-error' : '' }}">
        <label for="option_2" class="col-md-4 control-label"><span style="color:#18BC9C;" ></span></label>

        <div class="col-md-6">
          <input id="option_2" type="text" class="form-control" name="option_2" placeholder="Enter option_2">

          @if ($errors->has('option_2'))
          <span class="help-block">
            <strong>{{ $errors->first('option_2') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('option_3') ? ' has-error' : '' }}">
        <label for="option_3" class="col-md-4 control-label"><span style="color:#38BC9C;" ></span></label>

        <div class="col-md-6">
          <input id="option_3" type="text" class="form-control" name="option_3" placeholder="Enter option_3">

          @if ($errors->has('option_3'))
          <span class="help-block">
            <strong>{{ $errors->first('option_3') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('option_4') ? ' has-error' : '' }}">
        <label for="option_4" class="col-md-4 control-label"><span style="color:#48BC9C;" ></span></label>

        <div class="col-md-6">
          <input id="option_4" type="text" class="form-control" name="option_4" placeholder="Enter option_4">

          @if ($errors->has('option_4'))
          <span class="help-block">
            <strong>{{ $errors->first('option_4') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
        <label for="answer" class="col-md-4 control-label"><span style="color:#18BC9C;" ></span></label>

        <div class="col-md-6">
          <input id="answer" type="text" class="form-control" name="answer" placeholder="Enter answer">

          @if ($errors->has('answer'))
          <span class="help-block">
            <strong>{{ $errors->first('answer') }}</strong>
          </span>
          @endif
        </div>
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
