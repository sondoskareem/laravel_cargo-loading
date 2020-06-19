<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factoring extends Model
{
    protected $fillable = [
        'name',
        'address',
        'company_id',
        'phone',
        'fax',
        'contract_exp',
        'advanced_rate',
        'reserve_ammount',
        'escrow_fee',
        'monthly_minimum',
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function representatives(){
        return $this->hasMany(Representative::class);
    }
}
