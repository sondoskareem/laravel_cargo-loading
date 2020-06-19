<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    protected $fillable = [
        'factoring_id',
        'representative',
        'rep_phone',
        'rep_email',
        'payment_email',
    ];
    public function factoring(){
        return $this->belongsTo(Factoring::class);
    }
}
