@extends('layouts.app')

@section('content')

                <div class="card">
                    <div class="card-header">Channels</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($channels as $channel)

                                    <tr>
                                        <td>{{$channel->title}}</td>
                                        <td><a href="{{route('channels.edit',['channel'=> $channel->id])}}" class="btn btn-primary">Edit</a></td>
                                        <td>
                                            <form action="{{route('channels.destroy',['channel'=>$channel->id])}}" method="post">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <input type="submit" value="Delete" class="btn btn-danger">
                                            </form>
                                        </td>

                                    </tr>


                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

@endsection
