<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageBookingService extends Model
{
    use HasFactory;


    protected $fillable=['packageBooking_id','service_id'];


    public function packageBooking()
    {
        return $this->belongsTo(PackageBooking::class,"packageBooking_id","id");
    }


    public function service()
    {
        return $this->belongsTo(Service::class,);
    }
}
