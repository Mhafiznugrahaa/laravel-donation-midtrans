<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Donation extends Model
{


    // relationship
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function payments() : HasMany
    {
        return $this->hasMany(Payment::class);
    }

}
