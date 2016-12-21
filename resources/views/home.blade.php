@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
</div>
<script>
$('#start-audio').click(function(){


});
$('#stop-audio').click(function(){
  $.get("http://socket.jyroneparker.com/command/audio-start", function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
    });

});

</script>

@endsection
