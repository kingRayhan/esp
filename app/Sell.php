<?php

namespace App;

use App\Doctor;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    protected $guarded = [];

    function product()
    {
        return $this->belongsTo('App\Product');
    }

    function slip()
    {
        return $this->belongsTo('App\Slip');
    }

    function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
