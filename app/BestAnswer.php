<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BestAnswer extends Model
{
    protected $fillable = ['reply_id', 'replier_id', 'discussion_id'];

    public function reply()
    {
        return $this->belongsTo('App\Reply');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function discussion()
    {
        return $this->belongsTo('App\Discussion');
    }
}
