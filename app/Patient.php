<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function referred()
    {
        return $this->hasMany('App\Referred');
    }
}
