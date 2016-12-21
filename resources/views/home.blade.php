@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <button class="btn btn-sm btn-default" id="start-audio" onclick="startAudio()"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                    <button class="btn btn-sm btn-default" id="stop-audio" onclick="stopAudio()"><i class="fa fa-microphone-slash" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function stopAudio(){
  var xmlHttp = new XMLHttpRequest();
   xmlHttp.open( "GET", http://socket.jyroneparker.com/command/audio-stop, false ); // false for synchronous request
   xmlHttp.send( null );
}
function startAudio(){
  var xmlHttp = new XMLHttpRequest();
   xmlHttp.open( "GET", http://socket.jyroneparker.com/command/audio-start, false ); // false for synchronous request
   xmlHttp.send( null );
}
</script>
@endsection
