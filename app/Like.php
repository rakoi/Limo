<?php

namespace App;
use App\Post;
use App\User;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function User(){
    	$this->belongsTo('App\User');
    }
    public function Post(){
    	$this->belongsTo('App\Post');
    }
}
