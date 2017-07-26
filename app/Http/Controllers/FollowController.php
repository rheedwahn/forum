<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Follow;

use Auth;

use Session;

class FollowController extends Controller
{
    public function follow($id)
    {
        Follow::create([
            'user_id' => Auth::user()->id,
            'discussion_id' => $id,
        ]);

        Session::flash('success', 'You are now following this Discussion');
        return redirect()->back();
    }

    public function unfollow($id)
    {
        $unfollow = Follow::where([ ['user_id', Auth::user()->id], ['discussion_id', $id] ])->first();

        $unfollow->delete();

        Session::flash('success', 'You have unfollowed this discussion');
        return redirect()->back();
    }
}
