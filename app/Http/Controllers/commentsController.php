<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CommentOnPost;
use App\comment;
use Auth;
use Illuminate\Http\Request;

class commentsController extends Controller
{

      use Notifiable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $post=Post::find($id);
        $data="hello";
        return response()->json($post->comments()->latest()->get());
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
    public function store(Request $request,$post_id)
    {
       $this->validate($request,array('comment'=>'required||max:255'));

        $post=Post::find($post_id);
        $comment=new comment();
        $comment->username=Auth::user()->username;
        $comment->comments=$request->comment;
        $comment->post()->associate($post);
        
    
       $comment->save();
        Auth::user()->notify(new CommentOnPost($comment));
       if($post->user!=Auth::user()){
        $post->user->notify(new CommentOnPost($comment));
        }

        //return redirect('home/#post'.$post->id);
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
        //
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
}
