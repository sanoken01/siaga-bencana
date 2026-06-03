<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Donation;
use App\Models\User;

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
        'goal_amount',
        'unique_key',
        'source',
        'user_id',
    ];

    protected $casts = [
        'report_date' => 'date',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTotalDonations()
    {
        return $this->donations()->sum('amount') ?? 0;
    }

    public function getDonationPercentage()
    {
        if (!$this->goal_amount || $this->goal_amount === 0) {
            return 0;
        }
        $total = $this->getTotalDonations();
        return min(100, ($total / $this->goal_amount) * 100);
    }
}

