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
        <button data-id="{{$device->id}}" class="btn btn-sm btn-default action-battery" id="battery"><i class="fa fa-battery-full" aria-hidden="true"></i></button>
        <button data-id="{{$device->id}}" class="btn btn-sm btn-default action-camera" id="camera"><i class="fa fa-camera-retro" aria-hidden="true"></i></button>
        <button data-id="{{$device->id}}" class="btn btn-sm btn-default action-texts" id="texts"><i class="fa fa-envelope" aria-hidden="true"></i></button>
        <br>
        <input id="" class="form-control action-send-text-text"  placeholder="Text Message Goes Here"/>
        <input id="" class="form-control action-send-phone"  placeholder="Phone"/>
        <button data-id="{{$device->id}}" class="btn btn-success btn-sm action-send-text"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
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


</div>

<script>
var startAudio = document.getElementsByClassName("action-start-audio");
var stopAudio = document.getElementsByClassName("action-stop-audio");
var getGps = document.getElementsByClassName("action-get-gps");
var vibrate = document.getElementsByClassName("action-vibrate");
var battery = document.getElementsByClassName("action-battery");
var images = document.getElementsByClassName("action-camera");
var sms = document.getElementsByClassName("action-texts");
var sendTexts = document.getElementsByClassName("action-send-text");
var texts = document.getElementsByClassName("action-send-text-text");
var phones = document.getElementsByClassName("action-send-phone");




for (var i = 0; i < battery.length; i++) {
    battery[i].addEventListener('click', function(){
      $.get("https://socketdroid.com/command/battery/" + $(this).data('id'), function(data, status){
        notifyMe("Getting battery info!");
        }, false);

});
}
for (var i = 0; i < images.length; i++) {
    images[i].addEventListener('click', function(){
      $.get("https://socketdroid.com/command/camera/" + $(this).data('id'), function(data, status){
        notifyMe("Snapping photo and emailing it to you!");
        }, false);

});
}
for (var i = 0; i < startAudio.length; i++) {
    startAudio[i].addEventListener('click', function(){
      $.get("https://socketdroid.com/command/audio-start/" + $(this).data('id'), function(data, status){
        notifyMe("Starting audio recording!");
        }, false);

});
}
for (var i = 0; i < stopAudio.length; i++) {
    stopAudio[i].addEventListener('click', function(){
      $.get("https://socketdroid.com/command/audio-stop/" + $(this).data('id'), function(data, status){
        notifyMe("Stopping audio recording and emailing you results!");
        }, false);
});
}
for (var i = 0; i < getGps.length; i++) {
    getGps[i].addEventListener('click', function(){
      $.get("https://socketdroid.com/command/gps/" + $(this).data('id'), function(data, status){
        notifyMe("Tracking device!");
      }, false);
});
}
for (var i = 0; i < vibrate.length; i++) {
  console.log(vibrate[i]);
    vibrate[i].addEventListener('click', function(){
      $.get("https://socketdroid.com/command/vibrate/" + $(this).data('id'), function(data, status){
        notifyMe("Vibrating device!");
      }, false);
});
}
for (var i = 0; i < sms.length; i++) {
    sms[i].addEventListener('click', function(){
      $.get("https://socketdroid.com/command/sms/" + $(this).data('id'), function(data, status){
        notifyMe("Getting SMS and emailing to you!");
      }, false);
});
}
for (var j = 0; j < sendTexts.length; j++) {
  console.log(j);
    sendTexts[j].addEventListener('click', function(){
      console.log(j);
      console.log(document.getElementsByClassName("action-send-text-text"));
      console.log(document.getElementsByClassName("action-send-phone"));

      $.post("https://socketdroid.com/sms-send/" + $(this).data('id'),{text:document.getElementsByClassName("action-send-text-text")[j-1].value,phone:document.getElementsByClassName("action-send-phone")[j-1].value}, function(data, status){
        notifyMe("Text is being sent!");
      }, false);
});
}

function initMap(lat,long) {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 20,
          center: uluru,
          mapTypeId: 'satellite'
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
        var socket = io.connect('https://socketdroid.com:6001');
          socket.on('gps', function (data) {
            var center = {lat:Number(data.data.gps.lat),lng:Number(data.data.gps.long)};
            marker.setPosition(center);

            // using global variable:
            map.panTo(center);
          })
          .on('battery', function(data){
            notifyMe('Battery level is at ' + Number(data.data.battery) * 100 + '%');
          });

      }
      function notifyMe(message) {
        var options = {
      icon: "https://socketdroid.com/marketing.png"
  }
  // Let's check if the browser supports notifications
  if (!("Notification" in window)) {
    alert("This browser does not support desktop notification");
  }

  // Let's check whether notification permissions have already been granted
  else if (Notification.permission === "granted") {
    // If it's okay let's create a notification
    var notification = new Notification(message,options);
  }

  // Otherwise, we need to ask the user for permission
  else if (Notification.permission !== 'denied') {
    Notification.requestPermission(function (permission) {
      // If the user accepts, let's create a notification
      if (permission === "granted") {
        var notification = new Notification(message,options);
      }
    });
  }

  // At last, if the user has denied notifications, and you
  // want to be respectful there is no need to bother them any more.
}

</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCDNt1biVyfA8h-eCZyZ69CKS6NNBCeEQ&callback=initMap">
    </script>
@endsection
