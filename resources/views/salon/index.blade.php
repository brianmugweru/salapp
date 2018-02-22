@extends('layouts.app')

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAi78hhiakcf_eT1sVJP0Vx3nHM1eI-TjI"></script>

<script type="text/javascript">
    function geocode(lat, lng, salon_id){
        var latlng = new google.maps.LatLng(lat, lng);

        var geocoder = new google.maps.Geocoder;

        geocoder.geocode({'location': latlng}, function(results, status){
            if(status == google.maps.GeocoderStatus.OK){
                if(results[0]) {
                    document.getElementById("locate"+salon_id).innerHTML = results[0].formatted_address;
                }else{
                    document.write('quite imposibble');
                }
            }
        });
    }
</script>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard <span style="float:right"><a href="/salon/create">add salon</a></span></div>

                <div class="panel-body" style="clear:both;">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table style="width:100%">
                        <tr>
                            <th>name</th>
                            <th>location</th>
                            <th>opening_time</th>
                            <th>closing_time</th>
                            <th>image</th>
                            <th>Ranking</th>
                            <th>Actions</th>
                        </tr>
                        @foreach ($salons as $salon)
                            <tr>
                                <script>geocode( {{ $salon->latitude }},{{ $salon->longitude }} , {{ $salon->id }})</script>
                                <td>{{ $salon->name }}</td>
                                <td id="locate{{$salon->id}}"></td>
                                <td>{{ $salon->opening_time }}</td>
                                <td>{{ $salon->closing_time }}</td>
                                <td><img src="{{ Storage::url( $salon->image ) }}" height="50" width="50" alt="found"/></td>
                                <td>{{ $salon->ranking }}</td>
                                <td>
                                    <a href="{{ URL::to('/salon/'. $salon->id .'/edit') }}">edit</a><br>
                                    <a href="{{ URL::to('/salon/'. $salon->id) }}">view</a><br>
                                    {!! Form::open([ 'method'=>'DELETE','route'=>['salon.destroy', $salon->id]]) !!}
                                        {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                    <!--<a href="{{ URL::to('/salon/'. $salon->id) }}">delete</a>-->
                                </td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.geocode')
@endsection
