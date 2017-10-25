@extends('layouts.app');
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Question</div>

                <div class="panel-body">
                     <div class="col-md-6 col-md-offset-3">
                    <form class="form-horizontal" method="POST" action="/questions/{{$q->id}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{method_field('PATCH')}};

                        @if (session()->has('data'))
                        <div class="alert alert-success">{{session('data')}}</div>  
                        @endif

                        <div class="form-group">
                            <label for="category">Category:</label>

                                <select class="form-control" id="category" name="category_id">
                                    <option value="{{$q->category_id}}">Choose Category</option>
                                    @foreach ($categories as $cat)
                                    <option value="{{$cat->cid}}">{{$cat->name}}</option> 
                                    @endforeach

                                </select>
                            
                        </div>

                        <div class="form-group">
                          <label for="level">Level:</label>
                       
                              <select class="form-control" id="level" name="level_id">
                                 <option value="{{$q->level_id}}">Choose Level</option>
                                 @foreach ($levels as $level)
                                 <option value="{{$level->id}}">{{$level->name}}</option> 
                                 @endforeach
                             </select>
                         
                     </div>
                     <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                        <label for="question" class="col-md-4 control-label"><span style="color: #18BC9C;" ></span></label>

                        
                            <textarea id="question" type="text" rows="6" class="form-control" name="question" value=""
                            placeholder="Type the question here "  >{{ isset($q->question)? $q->question : old('question') }}</textarea>

                            @if ($errors->has('question'))
                            <span class="help-block">
                                <strong>{{ $errors->first('question') }}</strong>
                            </span>
                            @endif
                        
                    </div>
                    <div class="form-group{{ $errors->has('option_1') ? ' has-error' : '' }}">
                        <label for="option_1" class="col-md-4 control-label"><span style="color:#18BC9C;" ></span></label>

                        
                            <input id="option_1" type="text" class="form-control" name="option_1" placeholder="Enter option_1" value="{{ isset($q->option_1)? $q->option_1 : old('option_1') }}">

                            @if ($errors->has('option_1'))
                            <span class="help-block">
                                <strong>{{ $errors->first('option_1') }}</strong>
                            </span>
                            @endif
                       
                    </div>
                    <div class="form-group{{ $errors->has('option_2') ? ' has-error' : '' }}">
                        <label for="option_2" class="col-md-4 control-label"><span style="color:#18BC9C;" ></span></label>

                        
                            <input id="option_2" type="text" class="form-control" name="option_2" placeholder="Enter option_2" value="{{ isset($q->option_2)? $q->option_2 : old('option_2') }}">

                            @if ($errors->has('option_2'))
                            <span class="help-block">
                                <strong>{{ $errors->first('option_2') }}</strong>
                            </span>
                            @endif
                        </div>
                    
                    <div class="form-group{{ $errors->has('option_3') ? ' has-error' : '' }}">
                        <label for="option_3" class="col-md-4 control-label"><span style="color:#38BC9C;" ></span></label>

                        
                            <input id="option_3" type="text" class="form-control" name="option_3" placeholder="Enter option_3" value="{{ isset($q->option_3)? $q->option_3 : old('option_3') }}">

                            @if ($errors->has('option_3'))
                            <span class="help-block">
                                <strong>{{ $errors->first('option_3') }}</strong>
                            </span>
                            @endif
                        
                    </div>
                    <div class="form-group{{ $errors->has('option_4') ? ' has-error' : '' }}">
                        <label for="option_4" class="col-md-4 control-label"><span style="color:#48BC9C;" ></span></label>

                        
                            <input id="option_4" type="text" class="form-control" name="option_4" placeholder="Enter option_4" value="{{ isset($q->option_4)? $q->option_4 : old('option_4') }}">

                            @if ($errors->has('option_4'))
                            <span class="help-block">
                                <strong>{{ $errors->first('option_4') }}</strong>
                            </span>
                            @endif
                       
                    </div>
                    <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                        <label for="answer" class="col-md-4 control-label"><span style="color:#18BC9C;" ></span></label>

                        
                            <input id="answer" type="text" class="form-control" name="answer" placeholder="Enter answer" value="{{ isset($q->answer)? $q->answer : old('answer') }}">

                            @if ($errors->has('answer'))
                            <span class="help-block">
                                <strong>{{ $errors->first('answer') }}</strong>
                            </span>
                            @endif
                      
                    </div>


                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                             Update
                         </button>
                     </div>
                 </div>
             </form>
             </div>
         </div>
     </div>
 </form>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
