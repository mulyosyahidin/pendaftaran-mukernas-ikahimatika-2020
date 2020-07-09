<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registrant extends Model
{
    public function registrant_user()
    {
        return $this->belongsTo('App\User');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function region()
    {
        return $this->hasOne('App\Models\Region', 'id', 'region_id');
    }

    public function university()
    {
        return $this->hasOne('App\Models\University', 'id', 'university_id');
    }

    public function organization()
    {
        return $this->hasOne('App\Models\Organization', 'id', 'organization_id');
    }

    public function status()
    {
        return $this->hasOne('App\Models\Status', 'id', 'registration_status');
    }

    public function custom()
    {
        return $this->hasOne('App\Models\Registrant_custom_university');
    }
}
