<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $guarded=[];

    public function log(){
        return $this->morphTo();
    }
}
