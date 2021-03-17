<?php

namespace App\Http\Resources;
//use App\Http\Resources\TweetResource;
use App\Tweet;

use Illuminate\Http\Resources\Json\JsonResource;


class TweetResource extends JsonResource
{
   // public $preserveKeys = true;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lang=$request->header('lang');
        return [

            'tweet' => ($lang == 'en') ? $this->tweetdetl_en : $this->tweetdetl_ar,
        ];
    }
}
