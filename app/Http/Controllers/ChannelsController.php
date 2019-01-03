<?php

namespace App\Http\Controllers;

use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use App\Channel;
use Session;


class ChannelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     *
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('channels.index')->with('channels',Channel::all());
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
        $this->validate($request,[
            'channel'=> 'required|max:255'
        ]);
        Channel::create([
            'title'=> $request->channel,
            'slug'=> str_slug($request->title)
        ]);
        Session::flash('success','You Created A Channel');
        return redirect()->back();

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


        return view('channels.edit')->with('channel',Channel::find($id));


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
        $this->validate($request,[
            'channel'=> 'required|max:255'
        ]);

        $channel = Channel::find($id);

        $channel->title = $request->channel;
        $channel->slug = str_slug($request->channel);
        $channel->save();
        Session::flash('success','Channel Updated');
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
        Channel::destroy($id);
        Session::flash('success','You Deleted A Channel');
        return redirect()->back();
    }
}
