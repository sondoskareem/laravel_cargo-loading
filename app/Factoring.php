<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factoring extends Model
{
    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function representatives(){
        return $this->hasMany(Representative::class);
    }
}
