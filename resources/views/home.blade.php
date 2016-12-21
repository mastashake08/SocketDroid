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
                    <button class="btn btn-sm btn-default" id="get-gps"><i class="fa  fa-map-marker" aria-hidden="true"></i></button>
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

    });

});
$('#get-gps').click(function(){
  $.get("http://socket.jyroneparker.com/command/gps", function(data, status){

    });

});

$('#stop-audio').click(function(){
  $.get("http://socket.jyroneparker.com/command/audio-stop", function(data, status){

    });

});
function initMap(lat,long) {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
        var socket = io.connect('http://socket.jyroneparker.com:6001');
          socket.on('gps', function (data) {
            var center = {lat:Number(data.data.gps.lat),lng:Number(data.data.gps.long)};
            marker.setPosition(center);

            // using global variable:
            map.panTo(center);
          });
      }
      var grammar = 'start audio | end audio | get gps'
      var recognition = new webkitSpeechRecognition();
      var speechRecognitionList = new webkitSpeechGrammarList();
      speechRecognitionList.addFromString(grammar, 1);
      recognition.grammars = speechRecognitionList;
      //recognition.continuous = false;
      recognition.lang = 'en-US';
      recognition.interimResults = false;
      recognition.maxAlternatives = 1;
      recognition.continuous = true;
      recognition.onresult = function(event) {
  var command = event.results[0][0].transcript;
  console.log(command);
}
recognition.start();
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCDNt1biVyfA8h-eCZyZ69CKS6NNBCeEQ&callback=initMap">
    </script>
@endsection
