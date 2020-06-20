<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Load_stop extends Model
{
    protected $fillable = [
        'load_id',
        'load_type',
        'stop_description',
        'trailer_type',
        'facility',
        'address',
        'contact',
        'phone',
        'appointment_type',
        'facility_note',
    ];

    public function load(){
        return $this->belongsTo(Load::class);
    }
    public function commodity(){
        return $this->hasMany(Commodity::class);
    }
}
