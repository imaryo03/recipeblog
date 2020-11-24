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
  
  // レシピルーティング
  
    // レシピ一覧を表示
    Route::get('/', 'BlogController@index')->name('blog.index');
    // 自分の投稿一覧を表示
    Route::get('/mypage', 'BlogController@mypage')->name('blog.mypage');
    // レシピ登録画面表示
    Route::get('/blog/create', 'BlogController@create')->name('blog.create');
    
    // レシピ登録
    Route::post('/blog/store', 'BlogController@store')->name('blog.store');
    
    // レシピ詳細を表示
    Route::get('/blog/{id}', 'BlogController@show')->name('blog.show');
    
    // レシピ編集画面を表示
    Route::get('/blog/edit/{id}', 'BlogController@edit')->name('blog.edit');
    
    Route::post('/blog/update', 'BlogController@update')->name('blog.update');
    
    // レシピ削除
    Route::post('/blog/delete/{id}', 'BlogController@delete')->name('blog.delete');

    //  レシピ検索
    Route::post('/blog/search', 'BlogController@search')->name('blog.search');



  // twitter関連
    Route::get('/blog/tweet/create', 'TweetController@tweetindex')->name('tweet');
  
    Route::post('/blog/tweet/store/{blog_id}', 'TweetController@tweet')->name('tweet.store');

    Route::post('/blog/tweet/list/search', 'TweetController@tweetsearch')->name('tweet.search');

    Route::get('/blog/tweet/list', 'TweetController@tweetlist')->name('tweet.list');

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

  // コメントルーティング
    Route::post('/comment/store', 'CommentController@store')->name('comment.store');


  // 楽天レシピAPI関連
    // カテゴリー一覧取得・表示
    Route::get('/rakuten', 'RakutenController@index')->name('rakuten.index');
    // カテゴリーランキング取得・表示
    Route::get('/rakuten/recipe/{id}', 'RakutenController@recipe')->name('rakuten.recipe');
    // レシピ詳細表示
    Route::get('/rakuten/show/{recipeid}/{id}', 'RakutenController@show')->name('rakuten.show');
    // 楽天レシピからのレシピ投稿表示
    Route::get('/rakuten/blogcreate/{recipeid}/{id}', 'RakutenController@create')->name('rakuten.create');
    // 楽天レシピからのレシピ投稿
    Route::post('/rakuten/store', 'RakutenController@store')->name('rakuten.store');

    
});

