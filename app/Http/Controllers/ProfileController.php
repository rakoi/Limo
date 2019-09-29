<?php

namespace App\Http\Controllers;
use DB;
use App\Friend;
use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use Session;
class ProfileController extends Controller
{
   
  
    public function show($id)
    {   
        $user=User::where('username','=',$id)->first();
        $posts=Post::where('user_id','=',$user->id)->latest()->paginate(8);

        return view('pages.profile')->withUser($user)->withPosts($posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getFollowers($id)
    {
        
        $user=User::where('username','=',$id)->first();
        
         $posts=Post::where('user_id','=',$user->id)->paginate(8);
        return view('pages.followers')->withUser($user)->withPosts($posts);
    }
     public function getFollowing($id)
    {

        $user=User::where('username','=',$id)->first();
        //$friends=friend::where('sender_id','=',$user->id)->get();
        ///return $user->id;
        $posts=Post::where('user_id','=',$user->id)->paginate(8);
        return view('pages.following')->withUser($user)->withPosts($posts);//->withFriends($friends);
    }

    public function EditProfile($username){

        $user=User::where('username','=',$username)->first();
         $posts=Post::where('user_id','=',$user->id)->latest()->paginate(8);
        return view('pages.edit')->withUser($user)->withposts($posts);
   }
   public function UpdateProfile(Request $request,$username){
       $user=User::where('username','=',$username)->first();
        $user->location= $request->location;

        $user->username=$request->username;
        $user->birthday=$request->birthday;

        $user->save();
        Session::flash('Updated','Profile Updated');
        
         $posts=Post::where('user_id','=',$user->id)->paginate(8);

        return view('pages.profile')->withUser($user)->withposts($posts);
   }
   public function apigetUserDetails(Request $request){
    return Auth::user();
   }
}
