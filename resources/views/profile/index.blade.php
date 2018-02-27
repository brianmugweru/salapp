@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Your Authentication Details
            </div>

            <div class="panel-body">
                <dl>
                    <dt>Name</dt>
                    <dd>&nbsp;{{auth()->user()->name}}</dd>
                    <dt>Email</dt>
                    <dd>&nbsp;{{auth()->user()->email}}</dd>
                    <dt>Role</dt>
                    <dd>&nbsp;{{auth()->user()->role}}</dd>
                    <dt>Date Joined</dt>
                    <dd>&nbsp;{{auth()->user()->created_at}}</dd>
                </dl>
                <a class="btn btn-primary" href="/profile/update">update profile</a>
            </div>
        </div>
    </div>
</div>
@endsection
