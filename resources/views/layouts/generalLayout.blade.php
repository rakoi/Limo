<?php
use App\User;
 function getnonfriends($userid){

      $friends=DB::table('friendships')->where('sender_id','=',$userid)->pluck('recipient_id');
      $friends=$friends->toArray();
      array_push($friends,$userid);

      $notFriends=User::whereNotIn('id',$friends)->limit(30)->get();
      return $notFriends;
   }
   $allusers=getnonfriends(Auth::user()->id);
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Limo</title>


    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/starry.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/starry.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/myjquery.js') }}"></script>
  </head>
  <body>
     <nav class="nav nav-pills ">
          <li class="brand"><a href="/">Limo</a></li>
          <form class="searchform pull-left" action="/Search" method="GET">
                    {{ csrf_field() }}
            <input type="text" name="username" placeholder="username">
            <input type="submit" name="searchbtn" class="btn btn-default" 
            value="search">
          </form>


          @if(Auth::User())
    
        <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >
                                    Notifications<span class="badge">{{ count(Auth::user()->unreadNotifications) }}</span> <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu" id="notifications">
                                  <ul>
                                    @foreach(Auth::user()->unreadNotifications as $Notification)
    
                                          <li>
                                            @include('pages.'.snake_case(class_basename($Notification->type)))
                                         
                                          </li>
                                           @endforeach
                                    </ul>
                                   
                                </ul>
                            </li>
 </li>
          <li> <a href="/requests">Requests<span class="badge">
            {{ count(Auth::user()->getFriendRequests()) }}
          </span></a> </li>

          <li> <a href="#">Messages</a> </li>
          @endif


        
               @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                     <li><a href="/watchlist/{{Auth::user()->username}}">WatchList</a></li>
                                    <li><a href="/profile/{{Auth::user()->username}}">Profile</a>

                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    </li>

                                </ul>
                            </li>

                        @endif
                    </ul>
      
      </nav>
  <div class="body">
    <div class="row">
      <div class="col-md-4">
      @yield('suggestions')
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
           
             @foreach($allusers as $user)
             
                <form action="/Friend/{{$user->id}}" method="POST">
                {{ csrf_field() }}
                <img src="{{ asset('b.jpeg') }}" width="50" height="50">
                <a href="/profile/{{$user->username}}">{{$user->username}}</a> <br>
                <input type="submit" class="btn btn-danger pull-right" value=" Follow">
                </form>
                <hr>
              
              @endforeach

            
          </div>
        </panel>
        </div>

      



      </div>
    <div class="col-md-7"> 
        @yield('content')
        
    </div>
    
    
    <!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/myjquery.js"></script>
    -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/myjquery.js') }}"></script>

     <script src="{{ asset('js/app.js') }}"></script>
     <script src="{{ asset('js/vue.js') }}"></script>

    <script type="text/javascript">
              $(document).ready(function () {
            var starry = new Starry('#starry');
            starry.init({
              success: function (level) {
               $('#starvalue').val(level);
               // alert($('#starvalue').attr('value'))
              }
          });
        });
    </script>
  </body>
</html>