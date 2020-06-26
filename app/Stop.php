<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    protected $fillable = [
        'load_id',
        'load_type',
        'stop_description',
        'trailer_type',
        'facility',
        'address',
        'phone',
        'appointment_type',
        'facility_note',
    ]; 
    public function loads(){
        return $this->belongsTo(Load::class);
    }
}
