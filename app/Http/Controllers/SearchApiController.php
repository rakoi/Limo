<?php

namespace App\Http\Controllers;
use App\User;
use App\Post;
use Session;
use Illuminate\Http\Request;
class SearchApiController extends Controller
{
    //
    public function searchPost(Request $request){
    	$keyword=$request->keyword;
    	  $posts=Post::where('moviename','like',$keyword.'%')->orWhere('comment','like',$keyword.'%')->get();
    	return $posts;
    }
    public function searchUser(Request $request){
    	$keyword=$request->keyword;
    	$users=User::where('username','like',$keyword.'%')->orWhere('email','=',$keyword)->get();
    	return $users;
    }
}
