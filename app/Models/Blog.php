<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    // 可変項目
    protected $fillable =
    [
        'title',
        'content',
        'user_id',
        'recipe_img'
    ];

    protected $with = ['tags'];

    public function tags(){
        return $this->belongsToMany('App\Models\Tag');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

}
