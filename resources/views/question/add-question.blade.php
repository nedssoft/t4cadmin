@extends('layouts.app');
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Questions</div>

                     <div class="panel-body">
                       
                        <form class="form-horizontal" method="POST" action="/questions" enctype="multipart/form-data">
                        {{ csrf_field() }}

                          @if (session()->has('data'))
                            <div class="alert alert-success">{{session('data')}}</div>  
                           @endif
                       
                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select class="form-control" id="category" name="category_id">
                                    <option>Choose category</option>
                                    @foreach ($categories as $cat)
                                       <option value="{{$cat->cid}}">{{$cat->name}}</option> 
                                    @endforeach
                                  
                                </select>
                          </div>

                          <div class="form-group">
                              <label for="level">Level:</label>
                              <select class="form-control" id="level" name="level_id">
                                 <option>Choose Level</option>
                                  @foreach ($levels as $level)
                                  <option value="{{$level->id}}">{{$level->name}}</option> 
                                  @endforeach
                              </select>
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
                        
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                 Save
                                </button>
                            </div>
                        </div>
                    </form>
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
