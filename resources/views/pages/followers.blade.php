@extends('layouts.profilelayout')

@section('content')
  
  <?php $activeuser=Auth::user() ?>
  <?php
   $friends=$user->getFriends($perPage = 20);?>

   @if(Session::has('Friend Request'))
<div class="alert alert-success"> {{Session::get('Friend Request')}}</div>
@endif

@forelse($friends as $friend)

  <form action="/UnFriend/{{$friend->id}}" method="POST">
   {{ csrf_field() }}
      <img src="{{ asset('b.jpeg') }}" width="50" height="50">
      <a href="/profile/{{$friend->username}}">{{$friend->username}}</a> 
        <input type="submit" class="btn btn-danger pull-right" value=" Un Friend">
  </form>

 

 
           <hr>
@empty  
    <small>0 followers</small>

@endforelse

{{$friends->links()}}
@endsection