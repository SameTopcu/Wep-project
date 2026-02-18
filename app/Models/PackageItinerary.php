<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageItinerary extends Model
{
    use HasFactory;

    protected $table = 'package_itineraries';

    public function package(){
        return $this->belongsTo(Packages::class);
    }
}
