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

    public function registrant_custom_region()
    {
        return $this->belongsTo('App\Models\Registrant_custom_university');
    }
}
