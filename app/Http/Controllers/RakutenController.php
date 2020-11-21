<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use App\User;
class RakutenController extends Controller
{
    public function index()
    {
        $url = "https://app.rakuten.co.jp/services/api/Recipe/CategoryList/20170426?format=json&categoryType=large&applicationId=1054895675692734268";

        $method = "GET";
        $client = new Client();
        $response = $client->request($method, $url);
        $posts = $response->getBody();
        $posts = json_decode($posts, true);
        
      foreach($posts as $post){
         $items = $post;
      }

      $large_items=($items["large"]);
      return view('rakuten.index',['items'=>$large_items]);
       
    }

    public function recipe(){
      $url = "https://app.rakuten.co.jp/services/api/Recipe/CategoryRanking/20170426?format=json&categoryId=10&applicationId=1054895675692734268";

      $method = "GET";
      $client = new Client();
      $response = $client->request($method, $url);
      $posts = $response->getBody();
      $posts = json_decode($posts, true);
      
      foreach($posts as $post){
        $items = $post;
     }
     return view('rakuten.recipe', ['items'=>$items]);
    }

    public function show($id){
      $url = "https://app.rakuten.co.jp/services/api/Recipe/CategoryRanking/20170426?format=json&categoryId=10&applicationId=1054895675692734268";

      $method = "GET";
      $client = new Client();
      $response = $client->request($method, $url);
      $posts = $response->getBody();
      $posts = json_decode($posts, true);
      
      foreach($posts as $post){
        $items = $post;
     }
     $item=($items[$id]);
     return view('rakuten.detail',['item'=>$item , 'id'=>$id]);
    }
   

    public function create($id){
      $url = "https://app.rakuten.co.jp/services/api/Recipe/CategoryRanking/20170426?format=json&categoryId=10&applicationId=1054895675692734268";

      $method = "GET";
      $client = new Client();
      $response = $client->request($method, $url);
      $posts = $response->getBody();
      $posts = json_decode($posts, true);
      foreach($posts as $post){
        $items = $post;
     }
     $item=($items[$id]);

      $user_id = Auth::id();
      $tags =User::find($user_id)->tags()->get();
      return view('rakuten.form',['tags'=>$tags, 'user_id'=>$user_id ,'item'=>$item]);
  }
}

