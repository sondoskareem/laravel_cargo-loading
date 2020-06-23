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
        'business_fax',
    ];
  
    // protected static function boot()
    // {
    //     parent::boot();

    //     // auto-sets values on creation
    //     static::creating(function ($query) {
    //         $query->type = 'customer';
    //         $query->password = bcrypt('password');
    //     });
    // }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function loads(){
        return $this->hasMany(Load::class);
    }
}
