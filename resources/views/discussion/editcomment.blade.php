@extends('layouts.app')


@section('content')

    <div class="py-5">
        <div class="card">
            <div class="card-header">
                Edit Comment
            </div>
            <div class="card-body">
                <form action="{{route('comment.update',['id'=>$reply->id])}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <textarea name="comment" class="form-control" id="" cols="30" rows="10">{{$reply->content}}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endsection