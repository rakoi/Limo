<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Friend;
use Auth;
use DB;
use Config;

class PostApiController extends Controller
{
     public function apiShowAllPost(Request $request){

     	
      $friends=DB::table('friendships')->where('sender_id','=',Auth::user()->id)->pluck('recipient_id');
      $friends=$friends->toArray();

      array_push($friends, Auth::user()->id);
      $posts=Post::whereIn('user_id',$friends)->get();
      $notFriends=User::whereNotIn('id',$friends)->paginate(20);
      
        return $posts;

    }
    public function apiSinglePost(Request $request){

    	$post=Post::where('id',$request->id)->get();
    	return $post;
    }
    public function getMyPosts(Request $request){

    	$posts=Post::where('user_id',Auth::user()->id)->get();
    	return $posts;
    }
}
