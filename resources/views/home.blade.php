@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> Welcome, {{Auth::user()->name}} </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="alert alert-default alert-dismissable fade in">
                    <p><strong>Menu</strong></p><br>
                    <a href="/categories" class="btn btn-default">Category</a>
                    <a href="/contact" class="btn btn-default">Questions</a>
                    <a href="/account" class="btn btn-default">Badges</a>                   
                    <a href="/help" target="_blank" class="btn btn-default">Levels</a>
                    <a href="/help" target="_blank" class="btn btn-default">Points</a>
                    <a href="/help" target="_blank" class="btn btn-default">Admin</a>
                  </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
