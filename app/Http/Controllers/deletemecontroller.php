<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\User;
use Auth;
use Validator;
class ApiAuthRegisterController extends Controller
{
 
   public $successStatus = 200;
 
 
 
   /**
 
    * login api
 
    *
 
    * @return \Illuminate\Http\Response
 
    */
 
   public function login(){
 		$password= request('password');
 		
       if(Auth::attempt(['email' => request('email'), 'password' => $password])){
 
           $user = Auth::user();
 
           $success['token'] =  $user->createToken('MyApp')->accessToken;
 
           return response()->json(['success' => $success], $this->successStatus);
 
       }
 
       else{
 
           return response()->json(['error'=>'Unauthorised'], 401);
 
       }
 
   }
 
 
 
   /**
 
    * Register api
 
    *
 
    * @return \Illuminate\Http\Response
 
    */
 
   public function register(Request $request)
 
   {
 
       $validator = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'username'=>'required|string|max:25|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'birthday'=>'required',
                'location'=>'required|string',
                'password_confirmation'=>'required'

                ]);
 
 
       if ($validator->fails()) {
 
           return response()->json(['error'=>$validator->errors()], 401);            
 
       }
 
 
 
       $input = $request->all();
 
       $input['password'] = bcrypt($input['password']);
 
       $user = User::create($input);
 
       $success['token'] =  $user->createToken('MyApp')->accessToken;
 
       $success['name'] =  $user->name;
 
 
 
       return response()->json(['success'=>$success], $this->successStatus);
 
   }
 
 
 
   /**
 
    * details api
 
    *
 
    * @return \Illuminate\Http\Response
 
    */
 
   public function getDetails()
 
   {
 
       $user = Auth::user();
 
       return response()->json(['success' => $user], $this->successStatus);
 
   }
}
