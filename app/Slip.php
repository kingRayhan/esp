<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slip extends Model
{
    protected $guarded = [];

    protected function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    protected function orders()
    {
        return $this->hasMany(Sell::class);
    }
}
