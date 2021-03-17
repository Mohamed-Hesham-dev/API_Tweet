<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller as Controller ;
use Illuminate\Http\Request;
//use App\Http\Requests\Request;
use Validator;
use App\Follow;
use App\Tweet;
use Response;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use App\Http\Middleware\ChangeLanguage;


class FollowController extends Controller
{

    // follow user
    public function followUser(Request $request){


        // check if follower exist 
        $flag = Follow::where('user_id',auth()->user()->id)->where('follower_id',request()->follower_id)->first();
        if ($flag) {
            return response()->json(['message'=>'sorry you follow the user before','failed'=>400]);

        }
        $follow=new Follow;
        $follow->follower_id=$request->follower_id;
        $follow->user_id=Auth::user()->id;
        $follow->save();
        return response()->json(['message'=>'success','code'=>200]);

    }
    public function followerTweets(Request $request){
        $lang=$request->header('lang');
        if($lang =='ar'){
            $followers=Follow::where('user_id',Auth::user()->id)->pluck('follower_id');
            $tweets=Tweet::whereIn('user_id',$followers)->whereNotNull('tweet_ar')->paginate(5);
        }else{
            $followers=Follow::where('user_id',Auth::user()->id)->pluck('follower_id');
            $tweets=Tweet::whereIn('user_id',$followers)->whereNotNull('tweet_en')->paginate(5);
        }
       
        return response()->json(['data'=>$tweets,'message'=>'success','code'=>200]);
    
      

    }
}
