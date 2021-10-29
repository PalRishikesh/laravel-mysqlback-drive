<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public $guarded=[];
    public function comments(){
        return $this->morphMany(Comment::class,'commentable');
    }
    public function logs(){
        return $this->morphMany(Log::class,'log');
    }
}
