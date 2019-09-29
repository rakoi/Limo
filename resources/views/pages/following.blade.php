@extends('layouts.profilelayout')
@section('content')


	

  <?php $activeuser=Auth::user();
  		$friends=$user->getPendingFriendships();

   ?>
   
@if(Session::has('Friend Request'))
<div class="alert alert-success"> {{Session::get('Friend Request')}}</div>
@endif

@foreach($friends as $friend)
	             </form>
                 <img src="{{ asset('b.jpeg') }}" width="50" height="50">    <a href="/profile/{{$friend->recipient->username}}">{{$friend->recipient->username}}</a>
                    <form action="/cancelRequest/{{$friend->recipient->id}}" method="POST">
                    {{ csrf_field() }}
                     <input type="submit" class="btn btn-danger pull-right" value=" UnFollow">
                    </form>
               
                <br>

                 <hr>

@endforeach

@endsection

