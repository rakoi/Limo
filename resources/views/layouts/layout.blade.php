<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
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
      </div>
    <div class="col-md-5"> 
        @yield('content')
        
    </div>
    <div class="col-md-3">
        @yield('trending')

        <div class="well">
      <h4>What on Screens  </h4><hr>
      @foreach($trends as $trend)
      @foreach($trend as $t)
      <a href="/Search/{{$t}}">{{$t}}</a><br>
      @endforeach
      @endforeach
    </div>
  </div>

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


    $(document).ready(function(){
      $('.activity').each(function(){
        var state=$(this).children('#State').text();
        var likebutton=$(this).children('.like');
        var dislikebutton=$(this).children('.dislike');

        if(state.length==22) {
         
          likebutton.attr('id','liked');
        }
        if(state.length==26){
          dislikebutton.attr('id','disliked');
        }
        if (state.length==0) {
          likebutton.attr('id','DisLiked');
        }
      });
    });






      var _token='{{Session::token()}}';
      var urlLike='{{route('like')}}';


    
              $(document).ready(function () {
                var starry = new Starry('#starry');
                  starry.init({
                     success: function (level) {
                   $('#starvalue').val(level);
                  // alert($('#starvalue').attr('value'))
              }
            });
            });
      
        $('.like').each(function(){
          $(this).on("click",function(event){
              event.preventDefault(); 
              var postId=$(this).data('postid');
              var status=$(this).prev().text();
              var dislikebtn=$(this).next();
              var _token='{{Session::token()}}';
              var urlLike='{{route('like')}}';
              var isLike=true;  

               $.post(urlLike,{_token:"{{csrf_token()}}",isLike:isLike,postId:postId
              },function(){
                
            
              });
                if(status!='Liked'){
                  $(this).prev().text('Liked')
                  $(this).attr('id','liked');
                  dislikebtn.attr('id','');
                }else{
                  $(this).prev().text('');
                  $(this).attr('id','');
                }
          });
        });
        //DisLike
        $('.dislike').each(function(){
          $(this).on("click",function(event){
            event.preventDefault();
            var postId=$(this).data('postid');
            var likebtn=$(this).prev();
            var status=$(this).prev().prev().text();
            var _token='{{Session::token()}}';
            var urlLike='{{route('like')}}';
            var isLike=false;
              if(status!='DisLiked'){
                  $(this).prev().prev().text('DisLiked')
                  likebtn.attr('id','');
                  $(this).attr('id','disliked');
                }else{
                  $(this).prev().prev().text('');
                  $(this).attr('id','');
                }
                $.post(urlLike,{_token:"{{csrf_token()}}",isLike:isLike,postId:postId
              },function(){
              
              });
            
          })
        });
    </script>
    
  </body>
</html>