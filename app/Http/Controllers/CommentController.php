<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
   
    

    /**
     * コメント投稿する
     */
    public function store(CommentRequest $request)
    { $comment = new Comment;
        $inputs = $request->all();
        $comment->fill([
            'blog_id'=>$inputs['blog_id'],
            'name'=>$inputs['name'],
            'comment' => $inputs['comment'],
        ])->save();
      
       
        return redirect()->route('blog.show', [$comment['blog_id']]);
    }

}