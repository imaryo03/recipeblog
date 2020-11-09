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



use Illuminate\Routing\RouteGroup;


Auth::routes();
Route::get('/login/{provider}', 'Auth\LoginController@redirectToProvider')->where('provider', 'twitter|google');
Route::get('/login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->where('provider', 'twitter|google');

Route::group(['middleware' => 'auth'],function(){
  
  // ブログルーティング
  
    // ブログ一覧を表示
    Route::get('/', 'BlogController@index')->name('blog.index');
    
    // ブログ登録画面表示
    Route::get('/blog/create', 'BlogController@create')->name('blog.create');
    
    // ブログ登録
    Route::post('/blog/store', 'BlogController@store')->name('blog.store');
    
    // ブログ詳細を表示
    Route::get('/blog/{id}', 'BlogController@show')->name('blog.show');
    
    // ブログ編集画面を表示
    Route::get('/blog/edit/{id}', 'BlogController@edit')->name('blog.edit');
    
    Route::post('/blog/update', 'BlogController@update')->name('blog.update');
    
    // ブログ削除
    Route::post('/blog/delete/{id}', 'BlogController@delete')->name('blog.delete');

    //  レシピ検索
    Route::post('/blog/search', 'BlogController@search')->name('blog.search');


  // タグルーティング

    Route::get('/tag', 'TagController@index')->name('tag.index');
    
    // タグ登録画面表示
    Route::get('/tag/create', 'TagController@create')->name('tag.create');
    
    // タグ登録
    Route::post('/tag/store', 'TagController@store')->name('tag.store');
    
    // タグ詳細を表示
    Route::get('/tag/{id}', 'TagController@show')->name('tag.show');
    
    // タグ編集画面を表示
    Route::get('/tag/edit/{id}', 'TagController@edit')->name('tag.edit');
    
    Route::post('/tag/update', 'TagController@update')->name('tag.update');
    
    // タグ削除
    Route::post('/tag/delete/{id}', 'TagController@delete')->name('tag.delete');
    
    Route::get('/blog/tweet/create', 'TweetController@tweetindex')->name('tweet');

    Route::post('/blog/tweet/store/{blog_id}', 'TweetController@tweet')->name('tweet.store');
});

