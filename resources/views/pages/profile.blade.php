@extends('layouts.profilelayout')

@section('suggestions')


@endsection


@section('content')

@if(Session::has('Friend Request'))
<div class="alert alert-success"> {{Session::get('Friend Request')}}</div>
@endif


		 @forelse($posts as $post) 
    
     <panel class="panel-default">
        <div class="panel body">
        <img src="{{ asset('b.jpeg') }}" width="50" height="50">         <a href=""><b>{{$post->user->username }}</b></a>
          <h4><b>{{$post->username}}</b></h4><br>
           MovieName:{{$post->moviename}} <i><br> Rating:</i>
           {{$post->rating}}
           <img src="{{ asset('icons/rated.png') }}" height="30px">  <br>
          {{ $post->showPost }}
            </div>
        <div class="panel-footer">
          <a href=""><i class="glyphicon glyphicon-hand-down"></i></a>   12 
          <a href=""><i class="glyphicon glyphicon-hand-up"></i></a>   12 
          <i class="glyphicon glyphicon-comment">
          {{$post->comments->count()}}</i>
            @if($post->comments->count()>0)
              <a  href="" id="comment" >View Comments</a>
            @endif  
            <a href="" class="pull-right">Edit</a> 
          <span  >{{ $post->created_at->diffForHumans() }}</span>
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