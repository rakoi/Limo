
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
          <form class="searchform pull-left" action="/Search" method="getFriends">
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
  
      <img src="{{ asset('b.jpeg') }}" width="280" height="230" class="img-rounded" style="padding-left: 20px" >

<div class="persondetails">
  <h3>{{ $user->name }}</h3>
  <h4> {{ $user->username }} <h2>

  <h4><h3 class="glyphicon glyphicon-calendar" ></h3> Joined {{ $user->created_at->diffForHumans() }}</h4><br>

  <span class="glyphicon glyphicon-home"></span>
  <small>Location </small>{{$user->location}}<br>
  <span class="glyphicon glyphicon-time"></span>
  <small>Birthday </small>{{$user->birthday}} <br><hr>

  @if($user->username==Auth::user()->username)  
     <a href="/profile/edit/{{Auth::user()->username}}" class="btn-block btn btn-info">Edit Profile</a>

  @elseif(Auth::user()->isFriendWith($user))
    <form action="/UnFriend/{{$user->id}}" method="POST">
                {{ csrf_field() }}
       <input type="submit" class="btn btn-danger btn-block" value=" Un Friend">
    </form>
          
  @elseif($user->hasFriendRequestFrom(Auth::user()))
   <form action="/cancelRequest/{{$user->id}}" method="POST">
                {{ csrf_field() }}
    <input type="submit" class="btn btn-danger btn-block" value=" Un Follow">
    </form>
   @else
   <form action="/Friend/{{$user->id}}" method="POST">
    {{ csrf_field() }}
      <input type="submit" class="btn btn-block btn-danger pull-right" value=" Follows">
    </form>
  @endif

</div>
      </div>
    <div class="col-md-5"> 

  <table class="table">
  <thead>
    <tr>
      <th><a href="/profile/{{$user->username}}" class="profilelink">Posts</a> <span class="badge">{{$posts->count()}}</span></td></th>
      <th><a href="/profile/{{$user->username}}/followers" class="profilelink">Friends</a> <span class="badge">
      {{$user->getFriends()->count()}}
      </span></td></th>
      <th><a href="/profile/{{$user->username}}/following" class="profilelink">Following</a> <span class="badge">
        {{$user->getPendingFriendships()->count()}}
      </span></td></th>
       <th><a href="/watchlist/profile/{{$user->username}}" class="profilelink">Watchlist</a> <span class="badge">
       <i class="glyphicon glyphicon-play" style="color:gray"></i>
     </span></td></th>
    </tr>
  </thead>
  
  </table>

        @yield('content')
        
    </div>
    <div class="col-md-3">
        @yield('trending')
    </div>
  </div>

</div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!--
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/myjquery.js"></script>
    -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/myjquery.js') }}"></script>

     <script src="{{ asset('js/app.js') }}"></script>

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