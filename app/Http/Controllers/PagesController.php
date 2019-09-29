<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Friend;
use Auth;
use DB;
use Config;
class PagesController extends Controller
{

    public function getIndex(){
        $posts=Post::OrderBy('id','desc')->paginate(10);
    	return redirect()->route('login');
    }

    public function getHomepage(){

      
      $friends=DB::table('friendships')->where('sender_id','=',Auth::user()->id)->pluck('recipient_id');
      $friends=$friends->toArray();

      array_push($friends, Auth::user()->id);
      $posts=Post::whereIn('user_id',$friends)->latest()->paginate(30);
      $notFriends=User::whereNotIn('id',$friends)->paginate(20);
      
      
      //return $friends;
      return view('pages.homepage')->withPosts($posts)->withallusers($notFriends);

    }


   public function getRequests(){
      return view('pages.requests');
   }
  public function getnonfriends($userid){

      $friends=DB::table('friendships')->where('sender_id','=',$userid)->pluck('recipient_id');
      $friends=$friends->toArray();
      array_push($friends,$userid);

      $notFriends=User::whereNotIn('id',$friends)->limit(30)->get();
      return $notFriends;
   }


    public function apigetPosts(){

      return "HELLO";
     /* $friends=DB::table('friendships')->where('sender_id','=',Auth::user()->id)->pluck('recipient_id');
      $friends=$friends->toArray();

      array_push($friends, Auth::user()->id);
      $posts=Post::whereIn('user_id',$friends)->latest()->paginate(30);
      $notFriends=User::whereNotIn('id',$friends)->paginate(20);
      
      
      return json_encode($posts);
*/
    }
    public function apigetnonfriends(){
      $userid=Auth::user()->id;
      $friends=DB::table('friendships')->where('sender_id','=',$userid)->pluck('recipient_id');
      $friends=$friends->toArray();
      array_push($friends,$userid);

      $notFriends=User::whereNotIn('id',$friends)->limit(30)->get();
      return $notFriends;
     }

    


  
}

      //$statement="select * from posts where user_id in(SELECT recipient_id from friendships WHERE sender_id=".Auth::user()->id." )";
      //$statement1="select * from users where id not in(SELECT recipient_id from friendships WHERE sender_id=".Auth::user()->id.")"; 
      //SELECT * FROM `posts` INNER JOIN friendships on posts.user_id=friendships.sender_id 
    //SELECT * FROM `posts` INNER JOIN friendships on posts.user_id=friendships.sender_id where friendships.sender_id=1 
    