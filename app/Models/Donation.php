<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Report;

class Donation extends Model
{
    protected $fillable = [
        'report_id',
        'donor_name',
        'amount',
        'message',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
