@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Update Details
            </div>

            <div class="panel-body">
                <form action="/profile/update/{{ auth()->id() }}" method="post">
                    {{ csrf_field() }}
                    <label>Name: <input type="text" name="name" value="{{auth()->user()->name}}"/></label><br>
                    <label>Email: <input type="email" name="email" value="{{auth()->user()->email}}"/></label><br>
                    <input class="btn btn-primary" type="submit" name="submit" value="Update"/>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
