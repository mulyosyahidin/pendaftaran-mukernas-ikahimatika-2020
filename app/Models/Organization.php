<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public function university()
    {
        return $this->hasOne('App\Models\University', 'id', 'university_id');
    }

    public function registrant_organization()
    {
        return $this->belongsTo('App\Models\Registrant');
    }
}
