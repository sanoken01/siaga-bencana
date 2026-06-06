<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
       protected $fillable = [
        'report_id',
        'donor_name',
        'email',
        'amount',
        'payment_method',
        'message',
    ];

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }
}