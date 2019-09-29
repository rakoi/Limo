@extends('layouts.layout')
@section('content')
        <div class="well"><a href="">Login</a>
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                                 <a class="btn btn-link" href="/register">
                                    Register
                                </a>
                            </div>
                        </div>
                    </form>
                    </div>
                


        <?php $posts=App\Post::OrderBy('id','desc')->paginate(10); ?>

    @foreach($posts as $post)
     <panel class="panel-default">
        <div class="panel body">
        <img src="b.jpeg" width="50" height="50">
                 <a id="profilelink" href="/profile/{{$post->user->username }}"><b>{{$post->user->username }}</b></a>
          <h4><b id="username">{{$post->username}}</b></h4><br>
           MovieName:{{$post->moviename}} <i><br id="rating"> Rating:</i>
           {{$post->rating}}
           <img src="icons/rated.png" height="30px">  <br>
          {{ $post->comment }}
            </div>
        <div class="panel-footer">
          <a href=""><i class="glyphicon glyphicon-hand-down"></i></a>   12 
          <a href=""><i class="glyphicon glyphicon-hand-up"></i></a>   12 
          <i class="glyphicon glyphicon-comment">
          {{$post->comments->count()}}</i>
          <a id="comment" >Comment</a>     
          <span class="pull-right" >{{ $post->created_at->diffForHumans() }}</span>
        </div><br>

    </panel>
@endforeach
  
@endsection