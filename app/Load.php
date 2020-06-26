<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    protected $fillable = [
        'customer_id',
        'employee_id',
        'po_load',
        'load_rate',
        'loaded_mile',
        'load_type',
        'trailer_type',
        'endorsements',
        'number_of_stop',
        'trailer_model',
        'status',
    ];

    public function stops(){
        return $this->hasMany(Stop::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    
}
