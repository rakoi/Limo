<?php

namespace App;
use App\User;
use App\Series;
use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
	protected $table='Watchlist';
	
    public function user(){
    	return $this->belongsTo('App\User');
    }
   
       public function Series(){
    	return $this->belongsTo('App\Series');
    }
}

