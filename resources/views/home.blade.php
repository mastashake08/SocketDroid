@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
      #map {
       height: 400px;
       width: 100%;
      }
   </style>
   <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <button class="btn btn-sm btn-default" id="start-audio" ><i class="fa fa-microphone" aria-hidden="true"></i></button>
                    <button class="btn btn-sm btn-default" id="stop-audio"><i class="fa fa-microphone-slash" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Map</div>

                <div class="panel-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

$('#start-audio').click(function(){
  $.get("http://socket.jyroneparker.com/command/audio-start", function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
    });

});
$('#stop-audio').click(function(){
  $.get("http://socket.jyroneparker.com/command/audio-stop", function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
    });

});
function initMap(lat,long) {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
      var socket = io.connect('http://socket.jyroneparker.com:6001');
        socket.on('gps', function (data) {
          console.log(data);
          marker.setPosition({lat:data.lat,long:data.long)
        });
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCDNt1biVyfA8h-eCZyZ69CKS6NNBCeEQ&callback=initMap">
    </script>
@endsection
