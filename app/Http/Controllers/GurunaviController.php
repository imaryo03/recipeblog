<?php

namespace App\Http\Controllers;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;

class GurunaviController extends Controller
{
    public function index() {
      $gurunavi_key=config('services.gurunavi.application_id');
      $url = "https://api.gnavi.co.jp/master/GAreaLargeSearchAPI/v3/?keyid=".$gurunavi_key;
      
      
      $method = "GET";
      $client = new Client();
      $response = $client->request($method, $url);
      $posts = $response->getBody();
      $posts = json_decode($posts, true);
        
      foreach($posts as $post){
         $items = $post;
      }
      
      return view('gurunavi.index',['items'=>$items]);
       
    }

    public function shop($areacode,$page_id){
    
      $url = "https://api.gnavi.co.jp/RestSearchAPI/v3/?keyid=9d9012f889732b9640d05c0e48b7f085&areacode_l=".$areacode."&hit_per_page=20&offset_page=".$page_id;

      $method = "GET";
      $client = new Client();
      $response = $client->request($method, $url);
      $posts = $response->getBody();
      $posts = json_decode($posts, true);
      
      foreach($posts as $post){
        $items = $post;
     }
    
     $page_prev=$posts["page_offset"]-1;
     $page_next=$posts["page_offset"]+1;
     return view('gurunavi.shoplist', ['items'=>$items, 'areacode'=>$areacode, 'page_prev'=>$page_prev,'page_next'=>$page_next ,
     'page_id'=>$page_id]);
    }

    public function show($areacode,$page_id,$id){

      $url = "https://api.gnavi.co.jp/RestSearchAPI/v3/?keyid=9d9012f889732b9640d05c0e48b7f085&areacode_l=".$areacode."&hit_per_page=20&offset_page=".$page_id;   
      $method = "GET";
      $client = new Client();
      $response = $client->request($method, $url);
      $posts = $response->getBody();
      $posts = json_decode($posts, true);
      
      foreach($posts as $post){
        $items = $post;
     }
     $item=($items[$id]);
     return view('gurunavi.detail',['item'=>$item , 'id'=>$id , 'areacode'=>$areacode,'page_id'=>$page_id]);
    }
   

    public function create($areacode,$page_id,$id){
      $url = "https://api.gnavi.co.jp/RestSearchAPI/v3/?keyid=9d9012f889732b9640d05c0e48b7f085&areacode_l=".$areacode."&hit_per_page=20&offset_page=".$page_id;
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

      return view('gurunavi.form',['tags'=>$tags, 'user_id'=>$user_id ,'item'=>$item]);
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
        'recipe_img_rakuten'=>$inputs['recipe_img_gurunavi']
    ])->save();
    $blog->tags()->sync($request->tags);
    $blog_id =[
        'blog_id_i'=>Blog::find($blog->id)->id
    ];
    return redirect(route('tweet'))->withInput($blog_id);
}

    //
}
