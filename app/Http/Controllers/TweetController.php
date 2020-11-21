<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;



class TweetController extends Controller{

    public function tweetindex(Request $request){
        $blog_id  =$request->old('blog_id_i');
        return view('blog.tweet',['blog_id' => $blog_id]);
    }


    public function tweet(Request $request ,$blog_id) {

        $consumer_key =config('services.twitter.client_id');
        $consumer_secret =config('services.twitter.client_secret');
        $access_token =config('services.twitter.access_token');
        $access_token_secret =config('services.twitter.access_secret');
        //
        $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);


        // レシピを投稿する
        $connection->post("statuses/update",array(
            "status"=>'http://recipeblogimaryo.herokuapp.com/blog/'.$blog_id
        ));
        
        \Session::flash('err_msg','レシピを登録しました');
        return redirect(route('blog.index'));

    }

    public function tweetlist(){
        return view('twitter.list');
    }

    public function tweetsearch(Request $request) {

        $consumer_key =config('services.twitter.client_id');
        $consumer_secret =config('services.twitter.client_secret');
        $access_token =config('services.twitter.access_token');
        $access_token_secret =config('services.twitter.access_secret');
        //
        $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);


        // レシピを投稿する
        $hash_params = ['q' => '#'.$request->input ,'count' => '10', 'lang'=>'ja'];
        $tweets = $connection->get('search/tweets', $hash_params)->statuses;
        
       
        return view('twitter.search',['tweets' => $tweets]);

    }
}
