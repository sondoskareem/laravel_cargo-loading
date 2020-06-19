<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'description',
        'target',
        'company_id',
    ];

    public function employees(){
        return $this->hasMany(Employee::class);
    }

    public function drivers(){
        return $this->hasMany(Driver::class);
    }
}
