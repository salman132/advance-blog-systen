<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Discussion;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ForumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $discussion = Discussion::orderBy('created_at','desc')->paginate(3);
        switch (request('filter')){
            case 'me':

                $results = Discussion::where('user_id',Auth::id())->paginate(3);

                break;

            case 'solved':
                $answer = array();

                foreach (Discussion::all() as $discussion){

                    if($discussion->hasBestAnswer()){
                        array_push($answer,$discussion);
                    }
                }

                $results = new Paginator($answer,3);

                break;

            case 'pending':

                $unanswered = array();

                foreach (Discussion::all() as $disucssion){
                    if(!$disucssion->hasBestAnswer()){
                        array_push($unanswered,$disucssion);
                    }
                }

                $results = new Paginator($unanswered,3);

                break;

            default:

                $results = Discussion::orderBy('created_at','desc')->paginate(3);

                break;
        }
        return view('forum')->with('discussions',$results);
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
    public function update(Request $request, $id)
    {
        //
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
    public function channel($slug){
        $channel = Channel::where('slug',$slug)->first();

        return view('channels.channel')->with('discussions',$channel->discussion()->paginate(5));
    }
}
