<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function registrant_status()
    {
        return $this->belongsTo('App\Models\Registrant');
    }
}
