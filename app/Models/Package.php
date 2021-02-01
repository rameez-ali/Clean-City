<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PackageRequest;


class Package extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'recurrency',
        'staus',
        'price'
    ];


    public function packagerequest()
    {
        return $this->hasMany(PackageRequest::class);
    }
}
