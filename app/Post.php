<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use App\comment;
use App\User;
use App\Like;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	use Notifiable;
	public function User(){
		return $this->belongsTo('App\User');
	}


    public function comments(){
    	return $this->hasMany('App\comment');
    }
     public function like(){
        return $this->hasMany('App\Like');
    }

   /* public function getShowPostAttribute(){
    	return substr(strip_tags($this->comment), 0,255);
    }$post->comment->showPost*/
     public function getshowPostAttribute(){
 		
 		return substr($this->comment,0,225)."......";

 	}
 	


}
