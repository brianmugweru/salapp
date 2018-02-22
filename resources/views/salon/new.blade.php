@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard <span style="float:right"><a href="/salon">View Salons</a></span></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-md-8 col-md-offset-2">
                        <form action="{{ url('salon') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" name="name" placeholder="Enter Salon Name"><br>
                            <input type="text" class="form-control" placeholder="Enter starting time" id="weekdaystart" name="opening_time"/><br>
                            <input type="text" class="form-control" placeholder="Enter Closing time" id="weekdayend" name="closing_time"/><br>
                            <button type="button" class="btn btn-md" data-toggle="modal" data-target="#myModal"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Select location for salon</button><br><br>
                            <input type="hidden" id="map-lat" name="latitude" value="">
                            <input type="hidden" id="map-lon" name="longitude" value="">
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
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content" style="border-radius:10px">
            <div class="modal-header" style="border-radius:10px">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body" style="width:570px;height:400px;"> </div>
            <form class="form-horizontal" action="mapinputs" method="post" style="margin-bottom:20px">
                <div class="form-group">
                    <label class="col-sm-1 control-label" style="color:black">location:</label>
                    <div class="col-sm-5"><input type="text" class="form-control" id="map-address" placeholder="Enter a location" autocomplete="off"></div>
                    <div class="col-sm-6"><p>Drag the marker to select location</p></div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
@include('partials.timescript')
@include('partials.loc-picker')

@endsection
