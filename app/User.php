<?php

namespace App;
use App\Post;
use App\Watchlist;
use App\Friend;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Hootlex\Friendships\Traits\Friendable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;
    use Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','location','birthday','photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Post(){
        return $this->hasMany('App\Post');
    }
    public function WishList(){
        return $this->hasMany('App/Watchlist');
    }
    public function Like(){
        return $this->hasMany('App\Like');
    }


}
