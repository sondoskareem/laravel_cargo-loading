<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function employees(){
        return $this->hasMany(Employee::class);
    }

    public function drivers(){
        return $this->hasMany(Driver::class);
    }

    public function equipments(){
        return $this->hasMany(Equipment::class);
    }

    public function factorings(){
        return $this->hasMany(Factoring::class);
    }
}
