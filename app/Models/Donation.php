<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $guarded = [];

    public function bloodbank(){
        return $this->belongsTo(Bloodbank::class);
    }

    public function donor(){
        return $this->belongsTo(Donor::class);
    }
}
