<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function company(){
        return $this->belongsTo(Company::class);
    }
    
    public function positions(){
        return $this->belongsTo(Position::class);
    }

    public function loads(){
        return $this->hasMany(Load::class);
    }

}
