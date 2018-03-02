@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <form method="GET" action="/search">
                {{ csrf_field() }}
                <input type="text" name="salon" placeholder="enter salon name"/>
                <input type="submit" class="btn btn-primary" value="search" name="search">
            </form>
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-7" style="height:600px; overflow-y:auto;">
                <div class="row" id="eachloop">
                    @foreach($salons as $salon)
                    <div class="col-sm-6">
                        <a href="/salon/{{ $salon->id }}" onmouseout="hoverOut({{$salon}})" onmouseover="hoverListener({{$salon}})">
                            <img src="{{ $salon->image }}" width="100%" height="200">
                            <p style="text-align:left;">{{ $salon->name }}</br> {{ $salon->rank }}</p>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-5">
                <div id="map" style="height:500px;width:100%;background:#d3d3d3;"></div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script>
    var map;
    var salons = {!! json_encode($salons->toArray()) !!};
    var markers = [];
    var infoWindow = [];
    var position = [];
    var mylat;
    var mylon;

    navigator.geolocation.getCurrentPosition(showPosition);
    function showPosition(position){
        mylat = position.coords.latitude;
        mylon = position.coords.longitude;

        console.log('mylat:'+mylat+',mylng:'+mylon);
    }
    console.log('mylat:'+mylat+',mylng:'+mylon);

    function initMap(){

        map = new google.maps.Map(document.getElementById('map'),{
            zoom: 13,
            center:new google.maps.LatLng(-1.28755,36.7899),
            mapTypeId:'roadmap'
        });

        salons.forEach(function(salon){
            var marker = new google.maps.Marker({
                position:new google.maps.LatLng(salon.latitude,salon.longitude),
                map:map,
                salonId:salon.id
            });

            markers.push(marker);

            marker.addListener('click', function(){
                if(isInfoWindowOpen(infoWindow)){
                    infoWindow.open(map, marker);
                }else{
                    infoWindow.close();
                    infoWindow.open(map, marker);
                }
            });

            var infoWindow = new google.maps.InfoWindow({
                content: infoWindowText(salon)
            });
        });

        map.addListener('idle', function(){
            for(var i = 0; i<markers.length; i++){
                if(map.getBounds().contains(markers[i].getPosition())){
                    position.push('lat='+markers[i].salonId);
                }else{
                }
            }
            //getBounds();
            //window.location = 'location:8000/query?'+position.join('&');
            position.length = 0;
        });
    }

    function getBounds(){
        var bounds = map.getBounds();
        var areaBounds = {
            North: bounds.getNorthEast().lat(),
            South: bounds.getSouthWest().lat(),
            East: bounds.getNorthEast().lng(),
            West: bounds.getSouthWest().lng()
        }
        $.get('http://localhost:8000/?minlat='+areaBounds.North+'&maxlat='+areaBounds.South+'&minlng='+areaBounds.West+'&maxlng='+areaBounds.East, function(data, status){
            $('#eachloop').empty();
            $.each(data, function(index, salon) {
                var item = '<div class="col-sm-6">'+
                    '<a href="/salon/'+salon.id+'" onmouseout="hoverOut('+salon+')" onmouseover="hoverListener('+salon+')">'+
                        '<img src="' + salon.image + '" width="100%" height="200"/>'+
                        '<p style="text-align:left;">'+ salon.name +'</br>'+ salon.rank +'</p>'+
                    '</a>'+
                '</div>';
                $('#eachloop').append(item);
            });
        });
    }

    function isInfoWindowOpen(infoWindow){
        var map = infoWindow.getMap();
        return (map !== null && typeof map !== 'undefined');
    }

    /* set on hover function */
    function hoverListener(item){
        var latlng = new google.maps.LatLng(item.latitude, item.longitude);
        //map.setCenter(latlng);
        //map.panTo(latlng);
        for(var i = 0; i < markers.length; i++){
            if(markers[i].getPosition().equals(latlng)){
                /*console.log(markers[i].getPosition().lat()+" "+markers[i].getPosition().lng());*/
                markers[i].setIcon({
                    path:google.maps.SymbolPath.CIRCLE,
                    scale:8.5,
                    fillColor:"#f00"
                });

                /*markers[i].infoWindow = new google.maps.InfoWindow({
                    content: infoWindowText(item)
                });

                markers[i].infoWindow.open(map, markers[i]);
                */
                return;
            }
        }
    }

    function hoverOut(item){
        var latlng = new google.maps.LatLng(item.latitude, item.longitude);
        for(var i = 0; i < markers.length; i++){
            if(markers[i].getPosition().equals(latlng)){
                /*console.log(markers[i].getPosition().lat()+" "+markers[i].getPosition().lng());*/
                markers[i].setIcon();
                /*infoWindow.close();*/
                return;
            }
        }
    }
   function infoWindowText(salon) {
        var content ='<div id="panel panel-default">'+
                     '<div class="panel-heading"><h5>'+salon.name+'</h5></div>' +
                     '<div class="panel-body">' +
                     '<img src=http://localhost:8000/'+salon.image+' alt="'+salon.image+'" height="115" width="100%">' +
                     '<div>Opening Time<strong>'+salon.opening_time+'</strong></div><br>' +
                     '<div>Closing Time<strong>'+salon.closing_time+'</strong></div><br>' +
                     '<div>Rank<strong>'+salon.rank+'</strong></div>' +
                     '</div>';
        return content;
    }

   /* */
</script>
<script type="text/javascript" src='http://maps.google.com/maps/api/js?key=AIzaSyAi78hhiakcf_eT1sVJP0Vx3nHM1eI-TjI&callback=initMap'></script>
@endsection
