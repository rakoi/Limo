@extends('layouts.search')
@section('results')

<i>Searching for {{Session::get('Search')}}</i>
<hr>	
<div class="panel panel-body">
<br>
@forelse($users as $user)
@if($user!=Auth::user())
	<img src="b.jpeg" width="100" height="100">
				<a href="/profile/{{$user->username}}">{{$user->username}} </a><br>
				@if(Auth::user())
					<a class="btn btn-default pull-right" href="/profile/{{$user->username}}">View Profile</a>
				@endif
				<br><hr>
@endif
@empty
	<div class="alert alert-info">{{Session::get('Search')}} Not Found </div>			

@endforelse
{{$users->links()}}
</div>
@endsection
