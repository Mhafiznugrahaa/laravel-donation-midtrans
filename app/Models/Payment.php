<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{


    // relationship
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function donation() : BelongsTo
    {
        return $this->belongsTo(Donation::class);
    }

}
