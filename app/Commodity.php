<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    public function load_stop(){
        return $this->belongsTo(Load_stop::class);
    }
}
