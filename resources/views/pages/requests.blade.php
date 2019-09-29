@extends('layouts.layout')
 <?php $activeuser=Auth::user() ?>

<?php 
 $followers=$activeuser->getFriendRequests();
 ?>

@section('content')

 @forelse($followers as $follower)
 	<div class="panel">
 	<div class="panel-header">
 	  <img src="{{ asset('b.jpeg') }}" class="img-rounded" width="125" height="130"> 
 		<b><a href="/Profile{{$follower->sender->username}}">{{$follower->sender->name}}</a></b>
 		<div class="info" style="padding-left: 25%">
 		<small>{{$follower->sender->location}}</small><br>
 		
 		</div>
 		</div>
 	<div class="panel-body">
 		
 	<form <form action="/AcceptFriend/{{$follower->sender->id}}" method="POST">
 		{{ csrf_field()	}}
 		<button class="btn btn-default pull-right">Accept</button>
 	</form>
 	 </div>
 		
 	</div>

@empty
<h1>No Friend Requests</h1>


 @endforelse

 @endsection