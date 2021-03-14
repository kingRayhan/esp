<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slip extends Model
{
    protected $guarded = [];
    protected $dates = ['bill_date'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function orders()
    {
        return $this->hasMany(Sell::class);
    }
}
