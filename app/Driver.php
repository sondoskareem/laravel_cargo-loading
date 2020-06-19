<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'position_id',
        'birth',
        'dl_hash',
        'endorsements',
        'hazmat',
        'tanker',
        'double_triple',
        'dl_exp',
        'medical_exp',
        'pay_rate',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function position(){
        return $this->belongsTo(Position::class);
    }
}
