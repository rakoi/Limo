<?php

namespace App;
use App\Watchlist;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    //
    public function Watchlist(){
    	return $this->hasMany('App\Watchlist');
    }
}
