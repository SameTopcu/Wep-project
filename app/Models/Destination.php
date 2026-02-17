<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    public function packages()
    {
        return $this->hasMany(related: Packages::class);
    }
    public function photos()
    {
        return $this->hasMany(related: DestinationPhoto::class);
    }
    public function videos()
    {
        return $this->hasMany(related: DestinationVideo::class);
    }
}
