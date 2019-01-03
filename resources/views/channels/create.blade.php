@extends('layouts.app')

@section('content')

                <div class="card">
                    <div class="card-header">Create a New Channel</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>

                        @endif

                            <form action="{{route('channels.store')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <input type="text" name="channel" id="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="text-center">
                                        <input type="submit" value="Create" class="btn btn-success">
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>

@endsection
