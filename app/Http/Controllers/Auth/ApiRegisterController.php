<?php 
namespace App\Http\Controllers\Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Image;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;
class ApiRegisterController extends Controller
{
	private $client;

	public function __construct(){
		$this->client=Client::find(6);
	}

    public function register(Request $request){
    
       $validator = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'username'=>'required|string|max:25|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'birthday'=>'required',
                'location'=>'required|string',
               	//'password_confirmation'=>'required'

                ]);
        if ($validator->fails()) {
 
           return response()->json(['Register error'=>$validator->errors()], 401);            
 
       }
       $password=bcrypt($request['password']);
       $user=User::create([
       			'name'=>request('name'),
       			'email'=>request('email'),
       			'username'=>request('username'),
       		'password'=>$password,
       		'birthday'=>request('birthday'),
       		'location'=>request('location')
       	]);
 
    	$params=[
    		'grant_type'=>'password',
    		'client_id'=>$this->client->id,
    		'client_secret'=>$this->client->secret,
    		'username'=>$user->email,
    		'password'=>request('password'),
    		'scope'=>'*'
    	];
    	$request->request->add($params);
    	$proxy=Request::create('oauth/token','POST');
    	return Route::dispatch($proxy);
    }

    /*public function logout(Request $request){
    	return "HEHE";
    	$accessToken=Auth::user()->token();
    	DB::table('oauth_refresh_tokens')->where('access_token_id',Auth::user()->token())->update(['revoked'=>true]);
    	Auth::user()->token()->revoke();

    	return response()->json([],204);
    }*/

   
}


?>
