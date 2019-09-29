<?php

namespace App\Http\Controllers;
use App\User;
use App\Post;
use Session;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchtrend($moviename)
    {
       
       $posts=Post::where('moviename','like',$moviename.'%')->orWhere('moviename','like',$moviename.'%')->paginate(8);
       return view('pages.searchpost')->withposts($posts);
    }

    public function searchpost()
    {
       $searchitem=Session::get('Search');
       $posts=Post::where('moviename','like',$searchitem.'%')->orWhere('comment','like',$searchitem.'%')->paginate(8);
       return view('pages.searchpost')->withposts($posts);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //data passed as username //used for username and post:-|
        $username=$request->username;
        if(empty($username)){
            if (empty(Session::get('Search'))) {
                return redirect()->back();
            }else{
                $username=Session::get('Search');
            }
        }
        Session::put('Search',$username);
        $users=User::where('username','like',$username.'%')->orWhere('email','=',$username)->paginate(10);
        // ->paginate(10);
        $posts=Post::where('moviename','like',$username.'%')->orWhere('comment','like',$username.'%')->paginate(8);
        return view('pages.searchpeople')->withusers($users);
        
    }

   
}
