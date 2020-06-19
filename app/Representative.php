<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    public function factoring(){
        return $this->belongsTo(Factoring::class);
    }
}
