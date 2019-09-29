<?php 
namespace App\Http\Controllers\Auth;
use App\User;
use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Image;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;
class ApiLoginController extends Controller
{
    private $client;

    public function __construct(){
      $this->client=Client::find(6);
    }
	public function login(Request $request){

       $validator = Validator::make($request->all(),[
                'email' => 'required|string|max:255',
                'password' => 'required',
                ]);
        if ($validator->fails()) {
 
           return response()->json(['Register error'=>$validator->errors()], 401);            
 
       }  
       $params=[
        'grant_type'=>'password',
        'client_id'=>$this->client->id,
        'client_secret'=>$this->client->secret,
        'username'=>$request->email,
        'password'=>request('password'),
        'scope'=>'*'
      ];
      $request->request->add($params);
      $proxy=Request::create('oauth/token','POST');
      return Route::dispatch($proxy);
 
  } 
  public function refresh(Request $request){
    
       $validator = Validator::make($request->all(),[
                'refresh_token' => 'required'
                ]);
        $params=[
        'grant_type'=>'refresh_token',
        'client_id'=>$this->client->id,
        'client_secret'=>$this->client->secret,
        'username'=>$request->email,
        'password'=>request('password'),
        'scope'=>'*'
      ];

      $request->request->add($params);
      $proxy=Request::create('oauth/token','POST');
      return Route::dispatch($proxy);

  }
  public function logout(Request $request){

      $accessToken=Auth::user()->token();
      DB::table('oauth_refresh_tokens')->where('access_token_id',$token->id)->update(['revoked'=>true]);
     
     $accessToken->revoke();
      return response()->json([],204);
    }
}


?>
