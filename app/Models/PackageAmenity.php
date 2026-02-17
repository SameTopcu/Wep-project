<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageAmenity extends Model
{
    protected $table = 'package_emaneties';

    public function rAmenity()
    {
        return $this->belongsTo(Amenity::class, 'amenity_id');
    }
}
