<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    // 可変項目
    protected $fillable =[
        'title',
        'content',
        'user_id',
        'recipe_img',
        'recipe_url',
        'recipe_cost',
        'recipe_time',
        'recipe_img_rakuten'
    ];

    protected $with = ['tags'];

    public function tags(){
         return $this->belongsToMany('App\Models\Tag');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }
    
}
