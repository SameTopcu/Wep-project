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
        return $this->hasMany(PackagePhoto::class, 'package_id');
    }

    public function package_itineraries()
    {
        return $this->hasMany(PackageItinerary::class, 'package_id');
    }

    public function package_videos()
    {
        return $this->hasMany(PackageVideo::class, 'package_id');
    }

    public function package_faqs()
    {
        return $this->hasMany(PackageFaq::class, 'package_id');
    }

    public function tours(){
        return $this->hasMany(Tour::class, 'package_id');
    }
    public function bookings(){
        return $this->hasMany(Booking::class, 'package_id');
    }
    public function reviews(){
        return $this->hasMany(Review::class, 'package_id');
    }
    public function package_amenities(){
        return $this->hasMany(PackageAmenity::class, 'package_id');
    }
}
