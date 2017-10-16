<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referred extends Model
{
    protected $table = 'referred';
    
    public function patient()
    {
        return $this->belongsTo('App\Patient', 'patient_id');
    }
    
    public function doctor()
    {
        return $this->belongsTo('App\User', 'referred_user_id');
    }
}
