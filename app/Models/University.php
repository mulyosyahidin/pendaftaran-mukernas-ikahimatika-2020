<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    public function region()
    {
        return $this->hasOne('App\Models\Region', 'id', 'region_id');
    }

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }

    public function registrant_university()
    {
        return $this->belongsTo('App\Models\Registrant');
    }
}
