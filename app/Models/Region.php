<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function university()
    {
        return $this->belongsTo('App\Models\University');
    }

    public function registrant_region()
    {
        return $this->belongsTo('App\Models\Registrant');
    }
}
