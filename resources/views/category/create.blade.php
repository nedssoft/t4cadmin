@extends('layouts.app');
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $title }}</div>

                     <div class="panel-body">
                        @if($errors->any())
                        <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        </div>
                        @endforeach()
                        @endif
                        <div class="panel-body">
                            <form action="{{ route('category.store') }}" method="POST" class="form-horizontal">
                                {{ csrf_field() }}
                                {{-- Request Type --}}
                                {{ method_field('POST') }}
                                <div class="form-group">
                                    <label class="control-label col-sm-2" >Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" >Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" class="form-control" placeholder="Brief description of category" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" >Link to Category Image</label>
                                    <div class="col-sm-10">
                                        <input type="url" name="imgUrl" class="form-control" placeholder="Inclufe http(s)://" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary" name="Add categoty">Add Category</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection