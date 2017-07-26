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
    //dd(Request::ip());
});

Auth::routes();

Route::get('/forum', [
    'uses' => 'ForumsController@index',
    'as' => 'forum',
]);

Route::get('/leadership/board', [
    'uses' => 'ForumsController@leadershipBoard',
    'as' => 'leadership.board',
]);

Route::get('/search/result', [
    'uses' => 'ForumsController@searchResult',
    'as' => 'search.result',
]);

Route::get('/forum/{slug}', [
    'uses' => 'ForumsController@channel',
    'as' => 'channel',
]);

Route::get('{provider}/auth', [
    'uses' => 'SocialAuthController@auth',
    'as' => 'social.auth',
]);

Route::get('/{provider}/redirect', [
    'uses' => 'SocialAuthController@auth_callback',
    'as' => 'social.callback',
]);

Route::get('/discussions/{discussion}', [
    'uses' => 'DiscussionsController@show',
    'as' => 'discussions.show',
]);

Route::group(['middleware' => 'auth'], function() {

    Route::resource('channels', 'ChannelsController');

    //Route::resource('discussions', 'DiscussionsController');
    Route::get('/discussions/create/new', [
        'uses' => 'DiscussionsController@create',
        'as' => 'discussions.create',
    ]);

    Route::post('/discussions', [
        'uses' => 'DiscussionsController@store',
        'as' => 'discussions.store',
    ]);

    Route::post('/discussion/reply/{id}', [
        'uses' => 'DiscussionsController@replyDiscussion',
        'as' => 'submit.reply',
    ]);

    Route::get('reply/like/{id}', [
        'uses' => 'LikeUnlikeController@getLike',
        'as' => 'like',
    ]);

    Route::get('reply/unlike/{id}', [
        'uses' => 'LikeUnlikeController@getUnlike',
        'as' => 'unlike',
    ]);

    Route::get('/discussion/follow/{id}', [
        'uses' => 'FollowController@follow',
        'as' => 'discussions.follow',
    ]);

    Route::get('/discussion/unfollow/{id}', [
        'uses' => 'FollowController@unfollow',
        'as' => 'discussions.unfollow',
    ]);

    Route::get('/reply/best-answer/{id}', [
        'uses' => 'DiscussionsController@bestAnswer',
        'as' => 'reply.bestanswer'
    ]);

    Route::get('discussion/edit/{slug}', [
        'uses' => 'DiscussionsController@edit',
        'as' => 'edit.discussion',
    ]);

    Route::post('/discussion-update/{slug}', [
        'uses' => 'DiscussionsController@update',
        'as' => 'discussion.update',
    ]);

    Route::get('/reply-edit/{id}', [
        'uses' => 'DiscussionsController@editReply',
        'as' => 'reply.edit',
    ]);

    Route::post('/reply-update/{id}', [
        'uses' => 'DiscussionsController@updateReply',
        'as' => 'reply.update',
    ]);

    Route::get('/profile', [
        'uses' => 'ProfilesController@index',
        'as' => 'profile',
    ]);

    Route::post('/profile/update', [
        'uses' => 'ProfilesController@update',
        'as' => 'profile.update',
    ]);

});
