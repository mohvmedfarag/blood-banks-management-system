<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bloodbank extends Model
{
    protected $guarded = [];
    public function blood_samples(){
        return $this->hasMany(BloodSample::class);
    }

    public function donations(){
        return $this->hasMany(Donation::class);
    }

    public function requests(){
        return $this->hasMany(Request::class);
    }
}
