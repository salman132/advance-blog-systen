<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Like;
use App\Reply;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Notification;
use Session;

class DiscussionController extends Controller
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
        return view('discuss');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'channel_id'=> 'required',
            'question'=> 'required',
            'title'=> 'required'
        ]);

        $discussion = new Discussion();

        $user = Auth::user();

        $discussion->user_id = $user->id;
        $discussion->title = $request->title;
        $discussion->slug = str_slug($request->title);
        $discussion->content = $request->question;
        $discussion->channel_id = $request->channel_id;

        $discussion->save();
        Session::flash('success','You create a discussion');
        return redirect()->route('discussion.show',['slug'=>$discussion->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $discussion = Discussion::where('slug',$slug)->first();

        $best_answer = $discussion->replies()->where('best_answer',1)->first( );

        return view('discussion.show')->with('discussion',$discussion)->with('best_answer',$best_answer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $discussion = Discussion::where('slug',$slug)->first();

        if(Auth::id() == $discussion->user_id){
            return view('discussion.edit')->with('discussion',$discussion);
        }
        else{
            return redirect('forum');
        }
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
        $discussion = Discussion::find($id);

        $discussion->content = $request->question;

        $discussion->save();
        Session::flash('success','You Updated The Question');
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

    public function reply(Request $request, $id){

        $this->validate($request,[
            'comment'=> 'required'
        ]);

        $reply = new Reply();

        $reply->user_id = Auth::id();
        $reply->discussion_id = $id;
        $reply->content = $request->comment;
        $reply->save();

        $reply->user->points += 25;
        $reply->user->save();

        $d = Discussion::find($id);
        $followers = array();

        foreach ($d->follower as $f):
            array_push($followers,User::find($f->user_id));

        endforeach;

        Notification::send($followers,new \App\Notifications\NewReplyAdded($d));

        Session::flash('success','You gave a comment');

        return redirect()->back();


    }
    public function like($id)
    {
        $like = new Like();

        $like->reply_id = $id;
        $like->user_id = Auth::id();
        $like->save();
        Session::flash('success', 'You Liked a comment');

        return redirect()->back();
    }
    public function unlike($id){
        $unlike = Like::where('reply_id',$id)->where('user_id',Auth::id());

        $unlike->delete();
        return redirect()->back();
    }

    public function best_answer($id){
        $reply = Reply::find($id);

        $reply->best_answer = 1;
        $reply->save();

        $reply->user->points +=100;
        $reply->user->save();

        Session::flash('success','You marked this as a best answer');
        return redirect()->back();
    }

    public function comment($id){
        $reply = Reply::find($id);

        if(Auth::id() == $reply->user_id) {

            return view('discussion.editcomment')->with('reply', $reply);
        }
        else{
            return redirect('/forum');
        }


    }
    public function comup(Request $request,$id){

        $reply = Reply::find($id);

        $reply->content = $request->comment;
        $reply->save();
        Session::flash('success','You Updated the Comment');
        return redirect()->back();
    }

}
