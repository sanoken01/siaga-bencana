<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'title',
        'disaster_type',
        'location',
        'report_date',
        'description',
        'status',
        'latitude',
        'longitude',
        'prediction_percentage',
        'disaster_status',
    ];

    protected $casts = [
        'report_date' => 'date',
        'latitude' => 'float',
        'longitude' => 'float',
    ];
}