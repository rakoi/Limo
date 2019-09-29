@extends('layouts.search')
@section('results')

<i>Searching for {{Session::get('Search')}} </i><br><hr>

@forelse($posts as $post)

<div class="panel panel-body">
				
				 <img src="{{ asset('b.jpeg') }}" width="50" height="50">         <a href="/profile/{{$post->user->username}}"><b>{{$post->user->username }}</b></a>
          <h4><b>{{$post->username}}</b></h4><br>
           MovieName:{{$post->moviename}} <i><br> Rating:</i>
           {{$post->rating}}
           <img src="{{asset('icons/rated.png')}}	" height="30px">  <br>
          {{ $post->showPost }}
          <a href="/Post/{{$post->id}}" class="pull-right">View More</a>    <br>  
            </div>
       
			
@empty
	<div class="alert alert-info">{{Session::get('Search')}} Posts Not Found </div>			

@endforelse
{{$posts->links()}}

@endsection
@section('trending')
   
@endsection

