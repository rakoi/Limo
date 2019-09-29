@extends('layouts.layout')
@section('content')
 <?php $activeuser=Auth::user() ?>

  <div class="well" >
    <button id="rate" class="btn-block btn btn-warning">Rate a film</button>
    @if(count($errors)>0)
    <alert class="danger" style="color:red;">
       <ul>
      @foreach($errors->all() as $error)       
          <li>{{$error}}</li>
      @endforeach
      </ul>
    </alert>
    @endif

    <div id="form">
         <form method="POST" action="/Post"  role="form" class="form-horizontal">
        {{ csrf_field() }}

        <label>Movie</label>
          <input class="form-control" type="text" name="moviename" required=""><br>
          <label>Rating</label>
          <div id="starry" name="starry"></div>
          <input type="text" style="width:50px" name="stars" id="starvalue" hidden="true" class="disabled"><br>
          <label>Comments</label>
          <textarea name="comments" required class="form-control input-lg "></textarea><br>
          <input type="submit" value="Rate" class=" btn-block btn btn-warning">
          </form>
    </div>
  </div>       

  @forelse($posts as $post)
            
        <panel class="panel-default" id="app">
          <div class="panel body "  id="post{{$post->id}}">
              <img src="b.jpeg" width="50" height="50">         <a href="/profile/{{$post->user->username}}"><b>{{$post->user->username }}</b></a>
              <h4><b>{{$post->username}}</b></h4><br>
              MovieName:{{$post->moviename}} <i><br> Rating:</i>
              {{$post->rating}}
              <img src="icons/rated.png" height="30px">  <br>
              {{ $post->showPost }}
             <a href="/Post/{{$post->id}}" class="pull-right">View More</a>    <br>  
          </div>
          <div class="panel-footer"  >
          
          <!--      <div class="interaction">
          <a href="#"  data-postid="{{$post->id}}" class="like" ><i class="glyphicon glyphicon-hand-up"></i>{{
          Auth::user()->Like()->where('post_id',$post->id)->first() ? Auth::user()->Like()->where('post_id',$post->id)->first()->Islike == 1 ? 'You Like':'No Like':'No Actien'
           }}</a>    
          <a href="#"  data-postid="{{$post->id}}" ><i class="glyphicon glyphicon-hand-down dislike"></i>
            {{
          Auth::user()->Like()->where('post_id',$post->id)->first() ? Auth::user()->Like()->where('post_id',$post->id)->first()->Islike == 0 ? 'You Like':'No Like':'No Actien'
           }}
          </a>     

          </div> -->


          <!--  <span id="State">  {{
          Auth::user()->Like()->where('post_id',$post->id)->first() ? Auth::user()->Like()->where('post_id',$post->id)->first()->Islike == 1 ? 'Liked':' DisLike':''
           }}

           </span>
          <div class="interaction" id="app">
           <a href="#"  data-postid="{{$post->id}}" class="like" >
           <i class="glyphicon glyphicon-hand-up"></i></a>    
          <a href="#"  data-postid="{{$post->id}}" ><i class="glyphicon glyphicon-hand-down dislike"></i>
          </a>     

          </div> -->
          
          

            <button class="glyphicon glyphicon-hand-up" @click="liked({{$post->id}})"></button>  
              <button class="glyphicon glyphicon-hand-down" @click="disliked"></button> 
          
         
            <i class="glyphicon glyphicon-comment">
            {{$post->comments->count()}}</i>
            <small id="comments"   >Comments</small> 

            <i class="pull-right" >{{ $post->created_at->diffForHumans() }}</i>
            <div class="allcomments" class="allcomments" id="allcomments">
                  
            @foreach($post->Comments as $comment)
          
            <a href="profile/$comment->username">{{$comment->username}}</a><br>
          
            <div class="comment">{{$comment->comments}}</div>
            @endforeach
            </div>

           <form class="form"  action="/Comments/{{$post->id}}" id="commentfield" method="POST">
           {{csrf_field()}}
            <textarea class="form-control" name="comment"  ></textarea>
           
           <a href="/#post{{$post->id}}">
            <input type="submit" value="Comment" class="btn btn-default "><a/>
            <div class="viewallcomments pull-right" id="#post{{$post->id}}">
       
          View all comments</div>
          <div class="hideallcomments pull-right">Hide  comments</div>
         

        </form>
       
       
        </div>
        <br>

      </panel>
    
    

  @empty
  @endforelse 
{{$posts->links()}}
@endsection

@section('suggestions')
@if(Session::has('Friend Request'))
<div class="alert alert-success"> {{Session::get('Friend Request')}}</div>
@endif
  <div class="well" >
        <panel>
          <div class="panel-header">People You May Know
          <hr>
          </div>
          <div class="panel-body">
            @yield('suggestions')

             @foreach($allusers as $user)
             
                <form action="/Friend/{{$user->id}}" method="POST">
                {{ csrf_field() }}
                <img src="b.jpeg" width="50" height="50">
                <a href="/profile/{{$user->username}}">{{$user->username}}</a> <br>
                <input type="submit" class="btn btn-danger pull-right" value=" Follow">
                </form>
                <hr>
              
              @endforeach

            
          </div>
        </panel>
        </div>

      
@endsection


@section('trending')
   
@endsection


