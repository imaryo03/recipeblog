<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\User;
use App\Http\Requests\TagRequest;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * タグ一覧表示
     * @return view
     */
    public function index(){
        $user_id = Auth::id();
        $tags = User::find($user_id)->tags()->orderBy('id','desc')->paginate(10);
        return view('tag.list',['tags' => $tags]);
    }

    /**
     * タグ詳細表示
     * @param int $id
     * @return view
     */
    public function show($id){
        $tag = Tag::find($id);
        if (is_null($tag)){
            \Session::flash('err_msg','データがありません');
            return redirect(route('tag.index'));
        }
        $blogs = $tag->blogs()->paginate(20);
        return view('tag.detail',['tag' => $tag, 'blogs' => $blogs]);
    }

    /**
     * タグ登録画面表示
     * @return view
     */

    public function create(){
        $user_id = Auth::id();
        return view('tag.form', ['user_id'=>$user_id]);
    }

    /**
     * タグ登録する
     * @return view
     */

    public function store(TagRequest $request){
        // タグデータ受け取る
        $tag = new Tag;
        $inputs = $request->all();
        
        // タグ登録する
        $tag->fill([
            'user_id'=>$inputs['user_id'],
            'title'=>$inputs['title'],
        ])->save();
      
       
        return redirect(route('tag.index'));
        \Session::flash('err_msg','タグを登録しました');
        
    }

     /**
     * タグ編集フォーム表示
     * @param int $id
     * @return view
     */
    public function edit($id){
        $tag = Tag::find($id);
        if (is_null($tag)){
            \Session::flash('err_msg','データがありません');
            return redirect(route('tags'));
        }
        return view('tag.edit',['tag' => $tag]);
    }


     /**
     * タグ更新する
     * @return view
     */

    public function update(TagRequest $request){
        // タグデータ受け取る
        $inputs = $request->all();
        \DB::beginTransaction();
        try{
            // タグ更新する
            $tag = Tag::find($inputs['id']);
            $tag->fill([
                'title' => $inputs['title'],
               
            ])->save();
            \DB::commit();
        }catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        }
            
            \Session::flash('err_msg','タグを更新しました');
            return redirect(route('tag.index'));
        }
       

    /**
     * タグ削除表示
     * @param int $id
     * @return view
     */
    public function delete($id){

        if (empty($id)){
            \Session::flash('err_msg','データがありませんne');
            return redirect(route('tag.index'));
        }
        $tag = tag::find($id);
        $tag->blogs()->detach();
        try{
            // タグ削除する
            Tag::destroy($id);  
        }catch(\Throwable $e) {
            abort(500);
        }
        \Session::flash('err_msg','タグを削除しました');
        return redirect(route('tag.index'));

    }
}

