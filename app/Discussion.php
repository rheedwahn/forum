<?php

namespace App;

use Auth;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = ['user_id', 'channel_id', 'title', 'content', 'slug'];

    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }

    public function follows()
    {
        return $this->hasMany('App\Follow');
    }

    public function best_answer()
    {
        return $this->hasOne('App\BestAnswer');
    }

    public function is_followed_by_auth_user()
    {
        $id = Auth::user()->id;

        $follower = array();

        foreach($this->follows as $follow)
        {
            array_push($follower, $follow->user_id);
        }

        if(in_array($id, $follower))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
