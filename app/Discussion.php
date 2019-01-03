<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = ['title','content','user_id','channel_id'];

    public function channel(){
        return $this->belongsTo('App\Channel');
    }
    public function  replies(){
        return $this->hasMany('App\Reply');
    }

    public function  user(){
        return $this->belongsTo('App\User');
    }
    public function follower(){
        return $this->hasMany('App\Follower');
    }
    public function is_being_followed_bu_auth(){
        $id = Auth::id();

        $followers_ids = array();

        foreach ($this->follower as $f):
                array_push($followers_ids, $f->user_id);

            endforeach;

            if(in_array($id,$followers_ids)){
                return true;
            }
            else{
                return false;
            }
    }
    public function hasBestAnswer(){

        $result = false;
       foreach ($this->replies as $reply){
           if($reply->best_answer){
               $result = true;
               break;
           }
       }
       return $result;

    }
}
