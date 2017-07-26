<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Discussion;

use Illuminate\Pagination\Paginator;

use Auth;

use App\User;

use App\BestAnswer;

use Session;

use App\Channel;

class ForumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discussions = Discussion::orderBy('created_at', 'desc')->paginate(3);

        switch (request('filter'))
        {
            case 'me':
                if(!Auth::check())
                {
                    Session::flash('info', 'You need to login to view all your discussions');
                    return redirect()->route('login');
                }
                $result = Discussion::where('user_id', Auth::id())->paginate(3);
                break;
            
            case 'solved':
                // $result = new Paginator($discussions->best_answer, 3);
                $answer = array();
                foreach (Discussion::all() as $d)
                { 
                    if($d->best_answer)
                    {
                        array_push($answer, $d);
                    }
                }

                $result = new Paginator($answer, 3);
                break;
            
            case 'unsolved':
                $answer = array();
                foreach (Discussion::all() as $d)
                { 
                    if(!$d->best_answer)
                    {
                        array_push($answer, $d);
                    }
                }

                $result = new Paginator($answer, 3);
                break;
            
            default:
                $result = Discussion::orderBy('created_at', 'desc')->paginate(3);
                break;
        }

        return view('forum', ['discussion' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function channel($slug)
    {
        $channel = Channel::where('slug', $slug)->first();

        return view('channel')->with('discussion', $channel->discussions()->paginate(5));

    }

    public function leadershipBoard()
    {
        return view('leadership_board')->with('user', User::orderBy('points', 'desc')->paginate(10))
                                       ->with('best_answer', BestAnswer::all());
    }

    public function searchResult(Request $request)
    {
        if(!$request->search)
        {
            Session::flash('info', 'The seach field cannot be empty');
            return redirect()->back();
        }

        $search = $request->search;

        $result = Discussion::where('title', 'LIKE', "%{$search}%")->paginate(3);

        return view('result')->with('discussion', $result)
                             ->with('search_res', $request->search);
    }
}
