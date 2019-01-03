@extends('layouts.app')

@section('content')

    @foreach($discussions as $discussion)

        <div class="py-5">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <img src="{{$discussion->user->avatar}}" height="70px" width="70px" alt="{{$discussion->user->name}}">&nbsp;&nbsp;&nbsp;
                        <a href="">{{$discussion->user->name}}</a>

                        <h6>{{$discussion->created_at->diffForHumans()}}</h6>
                        <h6>{{$discussion->created_at->toFormattedDateString()}}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <h3>{{$discussion->title}}</h3>
                    {{str_limit($discussion->content,150)}}
                    <br>
                    <span><a href="{{route('discussion.show',['slug'=>$discussion->slug])}}" class="btn btn-primary pull-right">Read Post</a></span>
                </div>
                <div class="card-footer">
                    <p>
                        {{$discussion->replies->count() }} Replies
                    </p>
                    <div class="text-left">
                        <a href="{{route('channel',['slug'=>$discussion->channel->slug])}}">{{$discussion->channel->title}}</a>
                    </div>
                </div>
            </div>
        </div>

    @endforeach

    <div class="text-center">
        {{$discussions->links()}}
    </div>


@endsection
