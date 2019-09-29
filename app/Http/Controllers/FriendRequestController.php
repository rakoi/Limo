<?php
namespace App\Http\Controllers;
use Hootlex\Friendships\Traits\Friendable;
use Auth;
use App\User;
use Session;
use App\Friend;
use Illuminate\Http\Request;

class FriendRequestController extends Controller
{

    public function add($id){
        $recipient=User::find($id);
        Auth::user()->befriend($recipient);
        Session::flash('Friend Request','Friend Request Sent');
        return redirect()->back();
    }
    public function accept($id){
        $activeuser=Auth::user();
        $sender=User::find($id);
        $activeuser->acceptFriendRequest($sender);
        Session::flash('Friend Request','Friend Accepted');
        return redirect()->back();
        //return $id;
    }
    public function UnFriend($id){
        $user=User::where('id','=',Auth::user()->id)->first();
        $friend=User::where('id','=',$id)->first();
                
        Auth::user()->unfriend($friend);
        
        Session::flash('Friend Request','Unfriended '.$friend->username);
        return redirect()->back();
    
    }
    public function cancelRequest($id){
        $user=User::find($id);

        Auth::user()->unfriend($user);
        Session::flash('Friend Request','UnFollowed');
        return redirect()->back();

    }
}
