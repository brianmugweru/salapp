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

                    <div class="col-md-8 col-md-offset-2">
                        <form action="{{ url('dashboard/salon') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" name="name" placeholder="Enter Salon Name"><br>
                            <input type="text" class="form-control" placeholder="Enter starting time" id="weekdaystart" name="opening_time"/><br>
                            <input type="text" class="form-control" placeholder="Enter Closing time" id="weekdayend" name="closing_time"/><br>
                            <button type="button" class="btn btn-md" data-toggle="modal" data-target="#myModal"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Select location for salon</button><br><br>
                            <input type="hidden" id="map-lat" name="latitude" value="-1.3039908056715">
                            <input type="hidden" id="map-lon" name="longitude" value="36.775781123804">
                            <input type="text" class="form-control" name="address" id="us3-address" autocomplete="off"><br>
                            <input type="file" class="form-control" name="image"><br>
                            <input type="submit" name="submit" value="Add Salon" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include ('partials.map-picker');
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
@include ('partials.timescript')
@include ('partials.loc-picker')

@endsection
