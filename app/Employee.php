<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $fillable = [
        'user_id',
        'position_id',
        'company_id',
        'birth',
        'pay_rate_per_hour',
        'education',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

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
