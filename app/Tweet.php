<?php

namespace App;


use Illuminate\Database\Eloquent\Model;




class Tweet extends model 

{
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tweetdetl',
        'user_id',
    ];

    

}
