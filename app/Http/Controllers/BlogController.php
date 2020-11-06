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
    /**
     * ブログ一覧表示
     * @return view
     */
    public function index(){
        $user_id = Auth::id();
        $blogs = User::find($user_id)->blogs()->orderBy('id','desc')->paginate(10);
        return view('blog.list',['blogs' => $blogs]);
    }

    // レシピ検索する
    public function search(Request $request){
        $blogs = Blog::where('title', $request->input)->paginate(10);
        return view('blog.list',['blogs' => $blogs]);
        
    }

    /**
     * ブログ詳細表示
     * @param int $id
     * @return view
     */
    public function show($id){
        $blog = Blog::find($id);
        if (is_null($blog)){
            \Session::flash('err_msg','データがありません');
            return redirect(route('blog.index'));
        }
        $tags = $blog->tags()->get();
        return view('blog.detail',['blog' => $blog , 'tags' => $tags]);
    }

    /**
     * ブログ登録画面表示
     * @return view
     */

    public function create(){
        $user_id = Auth::id();
        $tags =User::find($user_id)->tags()->get();
        return view('blog.form',['tags'=>$tags, 'user_id'=>$user_id]);
    }

    /**
     * ブログ登録する
     * @return view
     */

    public function store(BlogRequest $request){
        // ブログデータ受け取る
        $blog = new Blog;
        $inputs = $request->all();
        if($request->hasFile('recipe_img')) {
            $file = $request->recipe_img;
            $fileName = time() . $file->getClientOriginalName();
            $target_path = public_path('uploads/');
            $file->move($target_path,$fileName);
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
        
        \Session::flash('err_msg','レシピを登録しました');
        return redirect(route('blog.index'));
    
    }

     /**
     * ブログ編集フォーム表示
     * @param int $id
     * @return view
     */
    public function edit($id){
        $user_id = Auth::id();
        $tags =User::find($user_id)->tags()->get();
        $blog = Blog::find($id);
        if (is_null($blog)){
            \Session::flash('err_msg','データがありません');
            return redirect(route('blog.index'));
        }
        return view('blog.edit',['blog' => $blog , 'tags'=>$tags ]);
    }


     /**
     * ブログ更新する
     * @return view
     */

    public function update(BlogRequest $request){
        // ブログデータ受け取る
        $inputs = $request->all();
        \DB::beginTransaction();
        try{
            // ブログ更新する
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
       

    /**
     * ブログ削除表示
     * @param int $id
     * @return view
     */
    public function delete($id){

        if (empty($id)){
            \Session::flash('err_msg','データがありませんne');
            return redirect(route('blog.index'));
        }
        // タグとブログの紐づけ解除
        Blog::find($id)->tags()->detach();
        // ユーザーとブログの紐づけ解除
        // $user_id = Auth::id();
        // User::find($user_id)->blogs()->dissociate()->save();

        try{
            // ブログ削除する
            
            Blog::destroy($id);  
        }catch(\Throwable $e) {
            abort(500);
        }
        \Session::flash('err_msg','レシピを削除しました');
        return redirect(route('blog.index'));

    }
}
