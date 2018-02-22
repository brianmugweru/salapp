
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src='http://maps.google.com/maps/api/js?key=AIzaSyAi78hhiakcf_eT1sVJP0Vx3nHM1eI-TjI&libraries=places'></script>
<script src="{{ asset('js/jquery.locationpicker.min.js') }}"></script>
<script>
        navigator.geolocation.getCurrentPosition(function(position) {
            function showPosition(position){
                var lat = position.coords.latitude;
                var lon = position.coords.longitude;
                $('.modal-body').locationpicker({
                    location:{
                        latitude:position.coords.latitude,
                        longitude:position.coords.longitude
                    },
                    radius:500,
                    inputBinding:{
                        latitudeInput: $('#map-lat'),
                        longitudeInput: $('#map-lon'),
                        radiusInput: $('#us3-radius'),
                        locationNameInput: $('#map-address')
                    },
                    enableAutocomplete: true
                });
                $("#myModal").on('shown.bs.modal',function(){
                    google.maps.event.trigger(map, 'resize');
                    initMap();
                });
            }
            showPosition(position);
        });
        alert("Please fill the form below to register salon");
</script>
