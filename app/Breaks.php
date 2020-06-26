<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Breaks extends Model
{
    protected $fillable = [
        'load_id',
        'load_type',
        'stop_description',
        'trailer_type',
        'facility',
        'address',
        'phone',
        'driver_work',
        'appointment_type',
        'facility_note',
    ];
    public function loads(){
        return $this->belongsTo(Load::class);
    }
}
