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
                                     <li><a href="/watchlist">WatchList</a></li>
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