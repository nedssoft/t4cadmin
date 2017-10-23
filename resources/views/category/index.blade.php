@extends('layouts.app');
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $title }}</div>

                <div class="panel-body">
                 @if(Session::has('flash_message'))
                     <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
                        {{-- Clear the session once message has been displayed --}}
                        $request->session()->forget('flash_message');
                  @endif
                <div class="table-responsive">
                <p class="pull-right"><a href='{{ route('category.create') }}' class="btn btn-link">Add a new category</a></p>
                <table class="table table-hover">
                    <tr>
                        <th>Category Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($category as $shwcat)
                        <tr>
                            <td>{{ $shwcat->cid }}</td>
                            <td>{{ $shwcat->name }}</td>
                            <td>{{ $shwcat->description }}</td>
                            <td><img src="{{ $shwcat->imgUrl }}" class="img-thumbnail" alt="{{ $shwcat->name }}" width="80" height="auto"></td>
                            <td><span class="pull-left"><a href="{{ route('category.edit', $shwcat->cid) }}" class="label label-warning">Edit   </span></a>   <span class="pull-right"><a href="{{ route('category.destroy', $shwcat->cid) }}" class="label label-danger" onclick="return confirm('Are you sure to delete this category?')">Delete</span></a></td>
                        </tr>
                    @endforeach                   
                </table>
                     {{ $category->links() }}
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection