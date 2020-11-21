<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //可変項目
    protected $fillable = [
        'blog_id',
        'name',
        'comment', 
    
    ];

    public function blog(){
        return $this->belongsTo('App\Models\Blog');
    }
}
