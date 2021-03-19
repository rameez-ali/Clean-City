<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\User;

class ServiceBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'status',
        'selected_date',
        //'time_required',
        'time_slot',
        //'quote',
        'recurrency',
        'reason',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function timeslot(){
        return $this->belongsTo(Timeslot::class,"time_slot");
    }

    
}
