<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $guarded = [];

    public function bloodbank(){
        return $this->belongsTo(Bloodbank::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
