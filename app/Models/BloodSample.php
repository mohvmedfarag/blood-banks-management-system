<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodSample extends Model
{
    protected $guarded = [];

    public function bloodbank(){
        return $this->belongsTo(Bloodbank::class);
    }
}
