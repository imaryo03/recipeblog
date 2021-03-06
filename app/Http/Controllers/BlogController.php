<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Blog;
use App\Models\Tag;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    // レシピ一覧表示
    public function index(){
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(10);
        return view('blog.list',['blogs' => $blogs]);
    }

    // レシピ検索する
    public function search(Request $request){
        $blogs = Blog::where('title', $request->input)->paginate(10);
        return view('blog.list',['blogs' => $blogs]);  
    }

     // 自分のレシピ一覧表示
     public function mypage(){
        $user_id = Auth::id();
        $blogs = User::find($user_id)->blogs()->orderBy('id','desc')->paginate(10);
        return view('blog.mypage',['blogs' => $blogs]);
    }

    // レシピ詳細表示
    public function show($id){
        $blog = Blog::find($id);
        if (is_null($blog)){
            \Session::flash('err_msg','データがありませんyo');
            return redirect(route('blog.index'));
        }
        $tags = $blog->tags()->get();
        $comments = $blog->comments()->get();
        return view('blog.detail',['blog' => $blog , 'tags' => $tags , 'comments' => $comments]);
    }

    //レシピ登録画面表示

    public function create(){
        $user_id = Auth::id();
        $tags =User::find($user_id)->tags()->get();
        return view('blog.form',['tags'=>$tags, 'user_id'=>$user_id]);
    }

    //レシピ登録する

    public function store(BlogRequest $request){
        // レシピデータ受け取る
        $blog = new Blog;
        $inputs = $request->all();
        if($request->hasFile('recipe_img')) {
            $file = $request->recipe_img;
            $fileName = time() . $file->getClientOriginalName();
            $target_path = public_path('uploads/');
            $filefile->move($target_path,$fileName);
        }else{
            $fileName = "";
        }
        
        $blog->fill([
            'user_id'=>$inputs['user_id'],
            'title'=>$inputs['title'],
            'content' => $inputs['content'],
            'recipe_img'=>$fileName
        ])->save();
        $blog->tags()->sync($request->tags);
        $blog_id =[
            'blog_id_i'=>Blog::find($blog->id)->id
        ];
        return redirect(route('tweet'))->withInput($blog_id);
    }

     //レシピ編集フォーム表示
     
    public function edit($id){
        $user_id = Auth::id();
        $tags =User::find($user_id)->tags()->pluck("title", "id");
        $blog = Blog::find($id);
        if (is_null($blog)){
            \Session::flash('err_msg','データがありません');
            return redirect(route('blog.index'));
        }
        return view('blog.edit',['blog' => $blog , 'tags'=>$tags ]);
    }


     //レシピ更新する

    public function update(BlogRequest $request){
        // レシピデータ受け取る
        $inputs = $request->all();
        \DB::beginTransaction();
        try{
            // レシピ更新する
            $blog = Blog::find($inputs['id']);
            $blog->fill([
                'title' => $inputs['title'],
                'content' => $inputs['content'],
            ])->save();
            $blog->tags()->sync($request->tags);
            \DB::commit();
        }catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        }
            
            \Session::flash('err_msg','レシピを更新しました');
            return redirect(route('blog.index'));
        }
       

    //レシピ削除表示
    
    public function delete($id){

        if (empty($id)){
            \Session::flash('err_msg','データがありませんne');
            return redirect(route('blog.index'));
        }
        // タグとレシピの紐づけ解除
        Blog::find($id)->tags()->detach();
        try{
            // レシピ削除する
            
            Blog::destroy($id);  
        }catch(\Throwable $e) {
            abort(500);
        }
        \Session::flash('err_msg','レシピを削除しました');
        return redirect(route('blog.index'));

    }
}
