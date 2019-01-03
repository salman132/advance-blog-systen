<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/discuss', function () {
    return view('discuss');
});
Auth::routes();

Route::get('/forum',[
    'uses'=> 'ForumsController@index',
    'as'=> 'forum'
]);
Route::get('discussion/{slug}',[
    'uses'=> 'DiscussionController@show',
    'as'=> 'discussion.show'
]);


Route::get('{provider}/auth',[
    'uses'=> 'SocialsController@auth',
    'as'=>'social.auth'
]);
Route::get('/{provider}/redirect',[
    'uses'=> 'SocialsController@auth_callback',
    'as'=> 'social.callback'
]);
Route::get('channel/{slug}',[
    'uses'=> 'ForumsController@channel',
    'as'=> 'channel'
]);

Route::group(['middleware'=> 'auth'],function(){

    Route::resource('channels','ChannelsController');

    Route::get('discussion/create/new',[
        'uses'=> 'DiscussionController@create',
        'as'=> 'discussion.create'
    ]);
    Route::post('discussion/store',[
        'uses'=> 'DiscussionController@store',
        'as'=> 'discussion.store'
    ]);

    Route::post('discussion/reply/{id}',[
        'uses'=>'DiscussionController@reply',
        'as'=> 'discussion.reply'
    ]);
    Route::get('Reply/Like/{id}',[
        'uses' => 'DiscussionController@like',
        'as'=> 'reply.like'
    ]);
    Route::get('reply/unlike/{id}',[
        'uses'=> 'DiscussionController@unlike',
        'as'=> 'reply.unlike'
    ]);
    Route::get('follow/discussion/{id}',[
        'uses'=> 'FollowerController@follow',
        'as'=> 'follow'
    ]);
    Route::get('unfollow/discussion/{id}',[
        'uses'=> 'FollowerController@unfollow',
        'as'=> 'unfollow'
    ]);
    Route::get('best/answer/{id}',[
        'uses'=> 'DiscussionController@best_answer',
        'as'=> 'best.answer'
    ]);
    Route::get('discussion/edit/{slug}',[
        'uses'=> 'DiscussionController@edit',
        'as'=> 'discussion.edit'
    ]);
    Route::post('discussion/update/{id}',[
        'uses'=> 'DiscussionController@update',
        'as'=> 'discussion.update'
    ]);
    Route::get('comment/edit/{id}',[
        'uses'=>'DiscussionController@comment',
        'as'=> 'edit.comment'
    ]);
    Route::post('comment/update/{id}',[
        'uses'=> 'DiscussionController@comup',
        'as'=> 'comment.update'
    ]);


});