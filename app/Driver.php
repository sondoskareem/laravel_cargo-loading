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
        'home_terminal',
        'dl_hash',
        'state',
        'endorsements',
        'hazmat',
        'tanker',
        'double_triple',
        'dl_exp',
        'medical_exp',
        'pay_rate',
        'profile_image',
    ];
    protected static function bootE()
    {
        parent::boot();
        static::creating(function($model){
            $model->type = 'driver';
        });
    }
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
