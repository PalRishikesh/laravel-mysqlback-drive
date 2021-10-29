<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $guarded=[];

    public function commentable(){
      return $this->morphTo();  
    }
}
