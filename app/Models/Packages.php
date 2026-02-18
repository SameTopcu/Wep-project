<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PackagePhoto;
use App\Models\PackageItinerary;
class Packages extends Model
{
    public function destination()
    {
        return $this->belongsTo(related: Destination::class);
    }

    public function package_photos()
    {
        return $this->hasMany(related: PackagePhoto::class);
    }

    public function package_itineraries()
    {
        return $this->hasMany(related: PackageItinerary::class);
    }

    public function package_videos()
    {
        return $this->hasMany(related: PackageVideo::class);
    }

    public function package_faqs()
    {
        return $this->hasMany(related: PackageFaq::class);
    }
}
