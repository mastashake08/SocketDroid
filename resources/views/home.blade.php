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
                  <table class="table">

    <tbody>
      @foreach(auth()->user()->devices as $device)
      <tr>
        <td>{{$device->phone}}</td>
        <td>
        <button data-id="{{$device->id}}" class="btn btn-sm btn-default action-start-audio" id="start-audio" ><i class="fa fa-microphone" aria-hidden="true"></i></button>
        <button data-id="{{$device->id}}" class="btn btn-sm btn-default action-stop-audio" id="stop-audio"><i class="fa fa-microphone-slash" aria-hidden="true"></i></button>
        <button data-id="{{$device->id}}" class="btn btn-sm btn-default action-get-gps" id="get-gps"><i class="fa fa-map-marker" aria-hidden="true"></i></button>
        <button data-id="{{$device->id}}" class="btn btn-sm btn-default action-vibrate" id="vibrate"><i class="fa fa-mobile" aria-hidden="true"></i></button>
      </td>
  </tr>
      @endforeach
    </tbody>
  </table>

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
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Phone</div>

                <div class="panel-body">
                    <form method="post" action="/device">
                      {{ csrf_field() }}
                      <input type="tel" class="form-control" name="phone" placeholder="Phone Number">
                      <button type="submit" class="btn btn-default">Add Device</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var startAudio = document.getElementsByClassName("action-start-audio");
var stopAudio = document.getElementsByClassName("action-stop-audio");
var getGps = document.getElementsByClassName("action-get-gps");
var vibrate = document.getElementsByClassName("action-vibrate");




for (var i = 0; i < startAudio.length; i++) {
    startAudio[i].addEventListener('click', function(){
      $.get("http://socket.jyroneparker.com/command/audio-start/" + startAudio[i].dataset.id, function(data, status){

        }, false);

});
}
for (var i = 0; i < stopAudio.length; i++) {
    stopAudio[i].addEventListener('click', function(){
      $.get("http://socket.jyroneparker.com/command/audio-stop/" + stopAudio[i].dataset.id, function(data, status){

        }, false);
});
}
for (var i = 0; i < getGps.length; i++) {
    getGps[i].addEventListener('click', function(){
      $.get("http://socket.jyroneparker.com/command/gps/" + getGps[i].dataset.id, function(data, status){

      }, false);
});
}
for (var i = 0; i < vibrate.length; i++) {
  console.log(vibrate[i]);
    vibrate[i].addEventListener('click', function(){
      $.get("http://socket.jyroneparker.com/command/vibrate/" + vibrate[i].dataset.id, function(data, status){

      }, false);
});
}
function initMap(lat,long) {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 20,
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
      var grammar = 'start recording|stop recording|get location| vibrate'
      var counter = 0;
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
  var command = event.results[counter][0].transcript.trim();
  console.log(command);
  counter++;
  switch(command){
    case 'start recording':
    $.get("http://socket.jyroneparker.com/command/audio-start"+ $('#start-audio').data('id'), function(data, status){

      });
      break;
      case 'stop recording':
      $.get("http://socket.jyroneparker.com/command/audio-stop"+ $('#stop-audio').data('id'), function(data, status){

        });
        break;
      case "get location":
      $.get("http://socket.jyroneparker.com/command/gps"+ $('#start-audio').data('id'), function(data, status){

        });

        break;
      case 'vibrate':
      $.get("http://socket.jyroneparker.com/command/vibrate"+ $('#start-audio').data('id') , function(data, status){

        });

        break;
  }
}
recognition.start();
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCDNt1biVyfA8h-eCZyZ69CKS6NNBCeEQ&callback=initMap">
    </script>
@endsection
