@extends('layouts.app')

@section('content')

    @if(Auth::id() == $discussion->user_id)
    <div class="card">
        <div class="card-header">Update Your Discussion</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>

            @endif

            <form action="{{route('discussion.update',['id'=>$discussion->id])}}" method="post">
                {{csrf_field()}}




                <div class="form-group">
                    <label>Ask a Question</label>
                    <textarea name="question" id="" cols="30" rows="10" class="form-control" placeholder="Ask Something ..." >{{$discussion->content}}</textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Update" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    @endif


@endsection
