<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{


    // relationship
    public function donations() : HasMany
    {
        return $this->hasMany(Donation::class);
    }
}
