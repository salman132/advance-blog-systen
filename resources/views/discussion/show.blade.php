@extends('layouts.app')

@section('content')

   <div class="card">
       <div class="card-header">
           <div class="card-title">
               <h2>{{$discussion->title}}</h2>
               <h5>Author: {{$discussion->user->name}}</h5>
               <time>{{$discussion->created_at->toFormattedDateString()}}</time>&nbsp;&nbsp;
               <time>{{$discussion->created_at->diffForHumans()}}</time>
           </div>
       </div>
       <div class="card-body">
           {!! Markdown::convertToHtml($discussion->content) !!}



           @if(Auth::id()== $discussion->user_id)

               <a href="{{route('discussion.edit',['slug'=>$discussion->slug])}}" >Edit Questions</a>

               @endif
       </div>
       <div class="card-footer">
           <p>
               {{$discussion->replies->count() }} Replies
           </p>
           <div class="comment">
               <hr>
               @if($best_answer)



                   <div class="text-center">
                       <div class="card card-header-tabs">
                           <div class="card-header">
                               <img src="{{asset($best_answer->user->avatar)}}" alt="{{$best_answer->user->name}} " height="80px" width="80px">&nbsp;&nbsp;
                               <a href="">{{$best_answer->user->name}}</a>
                               <time>{{$best_answer->created_at->diffForHumans()}}</time>
                           </div>

                           <div class="card-body">
                               <h6 class="text-success">Selected as a best answer : </h6>
                               {!! Markdown::convertToHtml($best_answer->content) !!}

                           </div>
                       </div>
                   </div>
               @endif
               <hr>
               @if(Auth::check())

                   <form action="{{route('discussion.reply',['id'=> $discussion->id])}}" method="post">
                       {{csrf_field()}}
                       <textarea name="comment" class="form-control" cols="30" rows="10" placeholder="Please Give Your Comment"></textarea>
                       <div class="form-group">
                           <input type="submit" value="Comment" class="btn btn-primary">
                       </div>
                   </form>
                   @else
                      <h2>Sign In to leave a reply</h2>
               @endif
           </div>

           <div class="commented">
               <div class="card">
                  @foreach($discussion->replies as $reply)


                      <div class="py-2">
                          <div class="card-header">
                              <img src="{{asset($reply->user->avatar)}}" alt="{{$reply->user->name}} " height="80px" width="80px">&nbsp;&nbsp;
                              <a href="">{{$reply->user->name}}</a> <b>{{$reply->user->points}}</b>
                              <time>{{$reply->created_at->diffForHumans()}}</time>


                          </div>
                          <div class="card-body">

                                {!! Markdown::convertToHtml($reply->content) !!}

                              @if(Auth::id()== $reply->user_id)

                                  <a href="{{route('edit.comment',['id'=>$reply->id])}}">Edit Your Comment</a>
                                  @endif
                              @if(!$best_answer)



                                  @if(Auth::id()== $discussion->user_id)

                                      <div class="text-right">
                                          <a href="{{route('best.answer',['id'=>$reply->id])}}" class="btn btn-primary">Mark As Best Answer</a>
                                      </div>

                                      @endif
                                  @endif

                              <div class="like">
                                  @if($reply->is_liked_by_auth_user())
                                      <a href="{{route('reply.unlike',['id'=> $reply->id])}}"> Unlike <span>{{$reply->likes->count()}} &nbsp;Likes</span></a>


                                      @else

                                      <a href="{{route('reply.like',['id'=> $reply->id])}}">
                                          {{----}}
                                          <span>{{$reply->likes->count()}}</span> &nbsp;  Like</a>

                                  @endif


                              </div>

                          </div>
                      </div>



                      @endforeach
               </div>
           </div>
       </div>
   </div>

@endsection
