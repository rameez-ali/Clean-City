<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\User;

class PackageBooking extends Model
{
    use HasFactory;
    protected $fillable=['user_id',
        'service_id',
        'selected_date',
        'time_slot',
        'time_required',
        'area',
        'recurrency',
        'first_name',
        'last_name',
        'phone',
        'address',
        'email'
    ];

    



    public function user(){
        return $this->belongsTo(User::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
