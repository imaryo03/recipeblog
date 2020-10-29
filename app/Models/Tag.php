<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // 可変項目
    protected $fillable =
    [
        'title',
        'user_id'
    ];


    public function blogs(){
        return $this->belongsToMany('App\Models\Blog');
    }
}
