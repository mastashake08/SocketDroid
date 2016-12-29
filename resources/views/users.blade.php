@extends('layouts.app')

@section('content')
@if(auth()->user()->email == 'jyrone.parker@gmail.com')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>

                <div class="panel-body">



                  <table class="table">

                  <tbody>
                    @foreach($users as $user)
                    <tr>
                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>



</div>
@endif()
@endsection
