@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard <span style="float:right"><a href="/dashboard/salon">View Salons</a></span></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        <h4>{{ $salon->name }}</h4>
                        <img src="{{ Storage::url( $salon->image )}}" height="300" width="80%" alt="found"/>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Opening time:<strong>  {{ $salon->opening_time }}</strong></p>
                                <p>Closing time:<strong>  {{ $salon->closing_time }}</strong></p>
                                <p>latitude: <strong> {{ $salon->latitude }}</strong></p>
                                <p>longitude: <strong> {{ $salon->longitude }}</strong></p>
                            </div>
                            <div class="col-md-6">
                                <p><a href="/dashboard/styles/{{ $salon->id }}">View Styles</a></p>
                                <p><a href="/dashboard/services/{{ $salon->id }}">View Services</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
