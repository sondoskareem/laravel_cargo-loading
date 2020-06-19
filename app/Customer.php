<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_id',
        'mc_number',
        'dot_number',
        'website',
        'invoive_factoring_approvment',
        'invoice_mail',
        'personal_fax',
        'business_fax ',
    ];
  

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function loads(){
        return $this->hasMany(Load::class);
    }
}
