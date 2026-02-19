<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Booking extends Model
{
    use HasFactory;


    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function package()
    {
        return $this->belongsTo(Packages::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
