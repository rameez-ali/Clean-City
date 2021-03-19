<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'validity',
        'time_required',
        'amount'
    ];


    public function timeslot()
    {
        return $this->hasMany(Timeslot::class);
    }
}
