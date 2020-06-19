<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $fillable = [
        'car_type',
        'plate',
        'company_id',
        'state',
        'make',
        'model',
        'color',
        'year',
        'service_type',
        'vin_number',
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
