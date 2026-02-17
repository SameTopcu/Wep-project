<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Amenity extends Model
{
    use HasFactory;

    public function package_emaneties()
    {
        return $this->hasMany(PackageAmenity::class);
    }
}
