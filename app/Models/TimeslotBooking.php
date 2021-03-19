<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeslotBooking extends Model
{
    use HasFactory;


    public function timeslot(){
        return $this->belongsTo(Timeslot::class);
    }
}
