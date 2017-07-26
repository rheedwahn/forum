<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Channel;

use Auth;

use Session;

class ChannelsController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Channel::all()->count() === 0)
        {
            Session::flash('info', 'You cannot create a discussion with an empty channel, please create a channel first');

            return redirect()->route('channels.create');
        }
        
        return view('channels.index')->with('channels', Channel::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('channels.create');
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
            'title' => 'required|unique:channels',
        ]);

        //dd($request->all());

        Channel::create([
            'title' => $request->title,
            'slug' => str_slug($request->title),
        ]);

        Session::flash('success', 'Channel created successfully');

        return redirect()->route('channels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($channel)
    {
        $channels = Channel::where('slug', $channel)->first();

        return view('channels.edit')->with('channel', $channels);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $channel)
    {
        $channels = Channel::where('slug', $channel)->first();

        if($channels->title !== $request->title)
        {
            $this->validate($request, [
            'title' => 'required|unique:channels'
             ]);

            $channels->title = $request->title;

            $channels->slug = str_slug($request->title);

            $channels->save();

            Session::flash('success', 'Channels updated successfully');

            return redirect()->route('channels.index');

        }

        Session::flash('info', 'You didnt make any changes');

        return redirect()->route('channels.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel)
    {
        $channels = Channel::where('slug', $channel)->first();

        $channels->delete();

        Session::flash('success', 'Channels deleted successfully');

        return redirect()->back();
    }
}
