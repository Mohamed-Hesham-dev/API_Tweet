<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller as Controller ;
use Illuminate\Http\Request;
use App\Http\Requests\TweetRequest;
use App\Http\Resources\TweetResource;
use Validator;
use App\Tweet;
use Response;

class TweetController extends Controller
{
    public function store(TweetRequest $request)
    {
        $lang=$request->header('lang');
        $tweet=new Tweet;
        if($lang =='ar'){
            $tweet->tweet_ar=$request->tweet;
        }else{
            $tweet->tweet_en=$request->tweet;
        }
       
        $tweet->user_id=Auth::user()->id;
        $tweet->save();
       return response()->json(['data'=>$tweet,'msg'=>'success','code'=>200]);
    }

    public function deleteTweet()
    {
        $tweet = Tweet::find(request()->id);
        $tweet->delete();
        return Response::json(['msg'=>'tweet deleted successfully','code'=>200]);
    }

}





?>