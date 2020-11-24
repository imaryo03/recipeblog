<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use App\User;
class RakutenController extends Controller
{
    public function index()
    {
      $applicationID = config('services.rakuten.application_id');
      $url = "https://app.rakuten.co.jp/services/api/Recipe/CategoryList/20170426?format=json&categoryType=large&applicationId=".$applicationID;
      
      
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

    public function recipe($recipeid){
      $applicationID = config('services.rakuten.application_id');
      $url = "https://app.rakuten.co.jp/services/api/Recipe/CategoryRanking/20170426?format=json&categoryId=".$recipeid."&applicationId=".$applicationID;

      $method = "GET";
      $client = new Client();
      $response = $client->request($method, $url);
      $posts = $response->getBody();
      $posts = json_decode($posts, true);
      
      foreach($posts as $post){
        $items = $post;
     }
     return view('rakuten.recipe', ['items'=>$items, 'recipeid'=>$recipeid]);
    }

    public function show($recipeid,$id){
      $applicationID = config('services.rakuten.application_id');
      $url = "https://app.rakuten.co.jp/services/api/Recipe/CategoryRanking/20170426?format=json&categoryId=".$recipeid."&applicationId=".$applicationID;


      $method = "GET";
      $client = new Client();
      $response = $client->request($method, $url);
      $posts = $response->getBody();
      $posts = json_decode($posts, true);
      
      foreach($posts as $post){
        $items = $post;
     }
     $item=($items[$id]);
     return view('rakuten.detail',['item'=>$item , 'id'=>$id , 'recipeid'=>$recipeid]);
    }
   

    public function create($recipeid,$id){
      $applicationID = config('services.rakuten.application_id');
      $url = "https://app.rakuten.co.jp/services/api/Recipe/CategoryRanking/20170426?format=json&categoryId=".$recipeid."&applicationId=".$applicationID;

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

  public function store(BlogRequest $request){
    // ブログデータ受け取る
    $blog = new Blog;
    $inputs = $request->all();    
    $blog->fill([
        'user_id'=>$inputs['user_id'],
        'title'=>$inputs['title'],
        'content' => $inputs['content'],
        'recipe_url' => $inputs['recipe_url'],
        'recipe_cost' => $inputs['recipe_cost'],
        'recipe_time' => $inputs['recipe_time'],
        'recipe_img_rakuten'=>$inputs['recipe_img_rakuten']
    ])->save();
    $blog->tags()->sync($request->tags);
    $blog_id =[
        'blog_id_i'=>Blog::find($blog->id)->id
    ];
    return redirect(route('tweet'))->withInput($blog_id);
}

}

