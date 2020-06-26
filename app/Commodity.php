<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    public function stop(){
        return $this->belongsTo(Stop::class);
    }
}
