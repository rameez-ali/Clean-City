<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    use HasFactory;


    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function timeslotBooking()
    {
        return $this->hasMany(TimeslotBooking::class,);
    }
}
