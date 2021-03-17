<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'API'],function ()
{
    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');
});




Route::middleware('jwt.auth')->get('/users', function (Request $request) {
    return auth()->user();
});

Route::middleware('jwt.auth')->group(function(){
    Route::resource('tweets','API\TweetController');
    Route::post('follow_user','API\FollowController@followUser');
    Route::get('get_follower_tweets','API\FollowController@followerTweets');
    Route::delete('delete_tweet','API\TweetController@deleteTweet');
    Route::post('logout','API\AuthController@logout');


    
   
});
