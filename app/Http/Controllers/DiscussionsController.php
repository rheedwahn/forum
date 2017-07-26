<?php

namespace App\Http\Controllers;

use App\Channel;

use App\Discussion;

use App\Reply;

use Auth;

use App\User;

use App\BestAnswer;

use Notification;

use Session;

use Illuminate\Http\Request;

class DiscussionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Channel::all()->count() === 0)
        {
            Session::flash('info', 'You cannot create a discussion with an empty channel, please create a channel first');

            return redirect()->route('channels.create');
        }
        
        return view('discussions.create')->with('channels', Channel::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'channel' => 'required',
            'content' => 'required',
        ]);

        $discussion = Discussion::create([
            'channel_id' => $request->channel,
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'slug' => str_slug($request->title),
        ]);

        Session::flash('success', 'Discussion created successfully');

        return redirect()->route('discussions.show', ['discussion' => $discussion->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($discussion)
    {
        $discussion = Discussion::where('slug', $discussion)->first();
        return view('discussions.show')->with('d', $discussion)
                                       ->with('best_answer', BestAnswer::where('discussion_id', $discussion->id)->first())
                                       ->with('b', BestAnswer::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $discussions = Discussion::where('slug', $slug)->first();

        return view('discussions.edit')->with('discussion', $discussions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        
        $discussion = Discussion::where('slug', $slug)->first();
        $channel = intval($request->channel);
        if($request->title === $discussion->title && $channel === $discussion->channel_id && $request->content === $discussion->content)
        {
             Session::flash('info', 'No changes made');
            return redirect()->back();
        }
        else{
       
            if($request->title !== $discussion->title)
                    {
                        $this->validate($request, [
                            'title' => 'required:unique:discussions',
                        ]); 
                        $discussion->title = $request->title;
                        $discussion->save();
                    }
                    if($request->channel !== $discussion->channel_id)
                    {
                        $this->validate($request, [
                            'channel' => 'required',
                        ]);
                        $discussion->channel_id = $request->channel;
                        $discussion->save();
                    }
                    if($request->content !== $discussion->content)
                    {
                        $this->validate($request, [
                            'content' => 'required',
                        ]);
                        $discussion->content = $request->content;
                        $discussion->save();
                    }

                    Session::flash('success', 'Discussions updated successfully');
                    return redirect()->route('discussions.show', ['slug' => $discussion->slug]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function replyDiscussion(Request $request, $id)
    {
        
        $this->validate($request, [
            'reply' => 'required',
        ]);

        $d = Discussion::find($id);

        $reply = Reply::create([
            'user_id' => Auth::user()->id,
            'discussion_id' => $id,
            'content' => $request->reply,
        ]);

        $reply->user->points += 10;

        $reply->user->save(); 

        $follows = array();

        foreach($d->follows as $follow)
        {
            array_push($follows, User::find($follow->user_id));
        }
        
        Notification::send($follows, new \App\Notifications\NewReply($d));

        Session::flash('success', 'Your reply has been saved...');

        return redirect()->back();
    }

    public function bestAnswer($id)
    {
        $reply = Reply::find($id);

        $best_answer = BestAnswer::create([
            'reply_id' => $id,
            'discussion_id' => $reply->discussion_id,
            'replier_id' => $reply->user_id,
        ]);

        $reply->user->points += 30;

        $reply->user->save();

        Session::flash('success', 'You marked this reply as your best answer');

        return redirect()->back();
    }

    public function editReply($id)
    {
        return view('replies.edit')->with('reply', Reply::find($id));
    }

    public function updateReply(Request $request, $id)
    {
        $reply = Reply::find($id);

        if($request->content !== $reply->content)
        {
            $this->validate($request, [
                'content' => 'required',
            ]); 

            $reply->content = $request->content;
            $reply->save();

            Session::flash('success', 'Reply updated successfully');
            return redirect()->route('discussions.show', ['slug' => $reply->discussion->slug]);
        }
    }
}
