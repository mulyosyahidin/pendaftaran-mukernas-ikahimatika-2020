<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registrant_custom_university extends Model
{
    public $timestamps = FALSE;

    public function registrant_custom()
    {
        return $this->belongsTo('App\Models\Registrant');
    }

    public function region()
    {
        return $this->hasOne('App\Models\Region', 'id', 'region_id');
    }
}
