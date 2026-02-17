<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    public function destination()
    {
        return $this->belongsTo(related: Destination::class);
    }
}
