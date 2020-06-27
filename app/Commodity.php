<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    protected $fillable = [
        'stop_id',
        'description',
        'Packaging',
        'quantity',
        'weight',
    ];
    public function stop(){
        return $this->belongsTo(Stop::class);
    }
}
