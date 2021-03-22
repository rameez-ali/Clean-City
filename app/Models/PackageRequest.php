<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;
use App\Models\User;


class PackageRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
            'package_id',
            'selected_date',
            //'time_required',
            //'time_slot',
            'recurrency',
            'first_name',
            'last_name',
            'email',
            'phone',
            'address',
            'book_from',
            'book_to',

    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function package(){
        return $this->belongsTo(Package::class);
    }

}
