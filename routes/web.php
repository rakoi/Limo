<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//pages controllers and stuff



Route::post('like',['uses'=>'PostController@postLikePost','as'=>'like']);

Route::get('/','PagesController@getIndex');
Route::get('/homepage',['uses'=>'PagesController@getHomepage'])->middleware('auth');
Route::get('/home', 'PagesController@getHomepage')->name('home')->middleware('auth');

//login and reg routes
Auth::routes();




Route::group(['middleware'=>'auth'],function(){
	Route::get('profile/{id}/followers','ProfileController@getFollowers');
	Route::get('profile/{id}/following','ProfileController@getFollowing');
	Route::get('profile/edit/{username}','ProfileController@EditProfile');
	
	//post
	Route::resource('Post','PostController');

	//Post 
Route::post('/Friend/{id}','FriendRequestController@add');

Route::post('/UnFriend/{id}','FriendRequestController@UnFriend');
Route::post('/cancelRequest/{id}','FriendRequestController@cancelRequest');
//Route::post('/profile/{username}/UnFriend/{id}','FriendRequestController@unfriend');
Route::post('AcceptFriend/{id}','FriendRequestController@accept');
Route::get('Search','SearchController@show');
Route::get('Search/{moviename}','SearchController@searchtrend');
Route::get('Search/posts','SearchController@searchpost');

Route::post('Comments/{id}','commentsController@store');
//profile stuff
Route::resource('profile','ProfileController');

//followers
Route::get('requests','PagesController@getRequests');

Route::get('viewpost/{id}','PostController@show');


Route::post('profile/update/{username}','ProfileController@UpdateProfile');
Route::get('users/{id}','PagesController@getnonfriends');

Route::get('watchlist/{username}','WatchListController@show');
Route::post('watchlist/add','WatchListController@store');
Route::post('watchlist/delete','WatchListController@destroy');
Route::post('watchlist/{id}/update','WatchListController@update');
Route::get('watchlist/profile/{username}','WatchListController@showuserwatchlist');

});
Route::post('test',function(){
	return "JEFFE";
});
