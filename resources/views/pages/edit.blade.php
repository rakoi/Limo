@extends('layouts.layout')
@section('suggestions')
<img src="{{ asset('b.jpeg') }}" width="280" height="230" class="img-rounded" style="padding-left: 20px" >

<div class="persondetails">
<form method="POST" action="/profile/update/{{$user->username}}">
  {{ csrf_field() }}
 
	<h3>{{ $user->name }} </h3>
 <i class="glyphicon glyphicon-user"></i>Username  <input type="username" name="username" value="{{ $user->username }}">
	<h4>  </h4>

	<span class="glyphicon glyphicon-home"></span>
	<small>Location </small>
  <input type="text" name="location" value="{{$user->location}}">
  <br>
	<span class="glyphicon glyphicon-time"></span>
	<small>Birthday </small>
  <input type="date" name="birthday" value="{{$user->birthday}}"> <br><hr>
    <input type="submit" class="btn-block btn btn-success" value="Update"  >
  
</form>

</div>

@endsection


@section('content')


	<table class="table">
	<thead>
		<tr>
			<th><a href="/profile/{{$user->username}}" class="profilelink">Posts</a> <span class="badge">{{$posts->count()}}</span></td></th>
			<th><a href="/profile/{{$user->username}}/followers" class="profilelink">Following</a> <span class="badge">
			{{$user->getFriends()->count()}}
			</span></td></th>
			<th><a href="/profile/{{$user->username}}/following" class="profilelink">Followers</a> <span class="badge">
				{{$user->getAcceptedFriendships()->count()}}
			</span></td></th>
		</tr>
	</thead>
	
	</table>


		 @forelse($posts as $post) 
    
     <panel class="panel-default">
        <div class="panel body">
        <img src="{{ asset('b.jpeg') }}" width="50" height="50">         <a href=""><b>{{$post->user->username }}</b></a>
          <h4><b>{{$post->username}}</b></h4><br>
           MovieName:{{$post->moviename}} <i><br> Rating:</i>
           {{$post->rating}}
           <img src="{{ asset('icons/rated.png') }}" height="30px">  <br>
          {{ $post->comment }}
            </div>
        <div class="panel-footer">
          <a href=""><i class="glyphicon glyphicon-hand-down"></i></a>   12 
          <a href=""><i class="glyphicon glyphicon-hand-up"></i></a>   12 
          <i class="glyphicon glyphicon-comment">
          {{$post->comments->count()}}</i>
          <a id="comment" >Comments</a>     
          <span class="pull-right" >{{ $post->created_at->diffForHumans() }}</span>
        </div><br>

    </panel>

  	

    @empty
    <small>0 posts</small>
    <?php $post=0 ?>

  @endforelse
  @if($post=0)
    <center>
     <a href="{{ $posts->nextPageUrl()}}">See More Posts{{$post->links}}</a>
     @endif
  </center>
 
 
@endsection