@extends('layouts.app')

@section('content')


                <div class="card">
                    <div class="card-header">Create a new Discussion</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>

                        @endif

                            <form action="{{route('discussion.store')}}" method="post">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" value="{{old('title')}}" class="form-control" placeholder="Title">
                                </div>

                                <div class="form-group">
                                    <label>Pick A Channel</label>
                                    <select name="channel_id" class="form-control">
                                        @foreach($channels as $channel)
                                            <option value="{{$channel->id}}">{{$channel->title}}</option>

                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Ask a Question</label>
                                    <textarea name="question" id="" cols="30" rows="10" class="form-control" placeholder="Ask Something ..." >{{old('question')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Ask" class="btn btn-primary">
                                </div>
                            </form>
                    </div>
                </div>


@endsection
