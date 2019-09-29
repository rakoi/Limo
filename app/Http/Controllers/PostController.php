<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Friend;
use Auth;
use DB;
use Config;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,array(
            'moviename'=>'required||max:25',
            'comments'=>'required',
            ));

        $user=User::find(Auth::user()->id);
        $post=new Post();
        $post->user_id=Auth::user()->id;
        $post->moviename=$request->moviename;
        $post->rating=$request->stars;
        $post->comment=$request->comments;

        $post->User()->associate($user);

        $post->save();
        Session::flash('status updated','You have Rated'.$post->moviename);
        return redirect()->back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $post=Post::find($id);
    

       $user=Auth::user();
       $comments=comment::where('post_id',$post->id)->orderBy('created_at','dsc')->get();
       // $comments=comment::first();

       return view('pages.singlepost')->withUser($user)->withPost($post)->withComments($comments);
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function postLikePost(Request $request){
            
        $post_id=$request->postId;
        $isLike=$request->isLike =='true'?true:false;
        $update=false;
        $post=Post::find($post_id);
        
        $user=Auth::user();
        $like=Like::where('post_id','=',$post_id,'AND','user_id','=',Auth::user()->id)->first();
       
        if($like){
            $liked=$like->Islike;
            $update=true;
            if($liked==$isLike){
                $like->delete();
                return null;
            }
        }else{
            $like=new Like();
        }
        $like->Islike=$isLike;
        $like->user_id=$user->id;
        $like->post_id=$post_id;

        if ($update) {
            $like->update();
        }else{
            $like->save();
        }
        return null;
    }   

}
