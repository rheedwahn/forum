<?php

namespace App\Http\Controllers;

use App\Channel;

use App\Discussion;

use App\Reply;

use App\Like;

use Auth;

use Session;

use Illuminate\Http\Request;

class LikeUnlikeController extends Controller
{
    public function getLike($id)
    {

        Like::create([

            'user_id' => Auth::user()->id,
            'reply_id' => $id,
            
        ]);

        Session::flash('success', 'You liked this reply');

        return redirect()->back();

    }

    public function getUnlike($id)
    {
        $like = Like::where([ 
            ['user_id', Auth::user()->id],
            ['reply_id', $id]
         ])->first();
        
        $like->delete();

        Session::flash('success', 'You unliked this reply');

        return redirect()->back();

    }
}
