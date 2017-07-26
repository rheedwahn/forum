<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\User;

use Session;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.index')->with('user', User::where('id', Auth::id())->first());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::where('id', Auth::id())->first();
        if($request->name !== $user->name || $request->email !== $user->email || $request->password || $request->avater)
        {
            if($request->name !== $user->name)
            {
                $this->validate($request, [
                    'name' => 'required',
                ]);
                $user->name = $request->name;
                $user->save();
            }
            if($request->email !== $user->email)
            {
                $this->validate($request, [
                    'email' => 'required|email|unique:users',
                ]);
                $user->email = $request->email;
                $user->save();
            }

            if($request->has('password'))
            {
                $this->validate($request, [
                    'password' => 'required|min:6',
                ]);
                $user->password = bcrypt($request->password);
                $user->save();
            }
            if($request->hasFile('avater'))
            {
                $this->validate($request, [
                    'avater' => 'image|max:500',
                ]);

                $avater = $request->avater;
                $avater_new_name = time() . $avater->getClientOriginalName();
                $avater->move('profile_uploads', $avater_new_name);
                $user->avater = 'profile_uploads/' . $avater_new_name;
                $user->save();
            }

            Session::flash('success', 'Profile Updated Successfully');
            return redirect()->back();
        }

        Session::flash('info', 'No changes were made');
        return redirect()->back();
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
}
