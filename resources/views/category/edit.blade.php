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
                            @endforeach()
                            </div>
                        @endif
                        <form action="{{ route('category.update', $category->cid) }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="form-group">
                                <label class="control-label col-sm-2" >Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" >Content</label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control" required>{{ $category->description }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" >Link to Category Image</label>
                                <div class="col-sm-10">
                                    <input type="text" name="imgUrl" class="form-control" value="{{ $category->imgUrl }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <p class="pull-left">
                                    <button type="submit" class="btn btn-primary">Update Category</button></p>
                                    <p class="pull-right">
                                        <form action="{{ route('category.destroy', $category->cid) }}">
                                            {{ method_field('DELETE') }}
                                            <button type="submit" onclick="return confirm('Are you sure to delete this category?')" class="btn btn-danger">Delete This Category</button>
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
