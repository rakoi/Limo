<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/details','ProfileController@apigetUserDetails')->middleware('auth:api');

Route::post('register','Auth\ApiRegisterController@register');
Route::post('login','Auth\ApiLoginController@login');
Route::post('refresh','Auth\ApiLoginController@refresh');
Route::post('logout','Auth\ApiLoginController@logout');
/*Route::get('posts','PostApiController@apiShowPost')->middleware('auth:api');
*/
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/posts', 'PostApiController@apiShowAllPost');
    Route::get('/posts/{id}', 'PostApiController@apiSinglePost');
    Route::post('Comments/{id}','commentsController@store');
	Route::get('users/{id}','PagesController@getnonfriends');	
   	Route::get('/searchpost/{keyword}','SearchApiController@searchPost');
   	Route::get('/searchusers/{keyword}','SearchApiController@searchUser');
   	Route::get('/myposts','PostApiController@getMyPosts');
});

Route::middleware('auth:api')->get('/user',function(Request $request){
		return Auth::user();
});

Route::get('get-nonFriends','PagesController@apigetnonfriends');
 


Route::get('Comments/{postid}/comments','commentsController@index');
Route::post('Comments/{id}','commentsController@store');
Route::get('users/{id}','PagesController@getnonfriends');	
Route::middleware('auth:api')->get('/users', function (Request $request) {
      return $request->user();
});
