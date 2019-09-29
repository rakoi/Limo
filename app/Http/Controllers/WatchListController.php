<?php

namespace App\Http\Controllers;
use App\Watchlist;
use Illuminate\Http\Request;
use App\User;
Use App\Series;
use Auth;
use Session;

class WatchListController extends Controller
{
    //
    public function show($username){
    	$user_id=Auth::user($username)->id;
    	$watchlist=watchlist::where('user_id','=',$user_id)->orderBy('created_at','db2_escape_string(string_literal)')->get();
    
    	return view('pages.watchlist')->withWatchlist($watchlist);
    }
    public function showuserwatchlist($username){
    
    	$user=User::where('username','=',$username)->first();
    	$watchlist=watchlist::where('user_id','=',$user->id)->get();
    	// /return $user->id;
    	if($user->id==Auth::user()->id){
    		return $this->show(Auth::user()->username);	

    	}


    	return view('pages.profilewatchlist')->withWatchlist($watchlist);
    }


    public function store(Request $Request){
    		$this->validate($Request,array(
    			'moviename'=>'required||max:25',
    			'Episode'=>'required||max:2',
    			'Season'=>'required||max:2'
    			));
    		$Watchlist=new Watchlist();
    		$Watchlist->user_id=Auth::user()->id;
    		$Watchlist->current_season=$Request->Season;
    		$Watchlist->current_episode=$Request->Episode;
    		$Watchlist->series_id=12;

    		$series=Series::where('series_name','=',$Request->moviename)->first();
    		if (empty($series)) {
    			$series=new Series();
    			$series->series_name=$Request->moviename;
    			$series->current_season=0;
    			$series->current_episode=0;
    			$series->save();
    		}
    		//return $series;

    		$Watchlist->Series()->associate($series);
    		$Watchlist->User()->associate(Auth::user());

    		$Watchlist->save();
    		Session::flash('Updated','Series Updated');

    		return redirect()->back();

    }
      public function update(Request $request,$id)
    {   

        $seriesid=$request->id;

        $watchlist=Watchlist::where('series_id','=',$seriesid)->first();
       // return $watchlist;
        $watchlist->current_season=$request->input('current_season');
        $watchlist->current_episode=$request->input('current_episode');
        $watchlist->save();
        //return $watchlist;
        Session::flash('Updated','Series Updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
            $id=$request->removemovieid;
            $watchlist=Watchlist::where('series_id','=',$id)->first();
            $watchlist->delete();
          
            
         return redirect()->back();
        //
    }
}

