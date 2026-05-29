<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Donation;

class DonationCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $donation;

    /**
     * Create a new event instance.
     */
    public function __construct(Donation $donation)
    {
        $this->donation = $donation->fresh();
    }

    /**
     * Get the channels the event should broadcast on.
     * We'll broadcast on a public channel 'donations' and on a per-report channel.
     */
    public function broadcastOn()
    {
        $channels = [new Channel('donations')];
        if ($this->donation->report_id) {
            $channels[] = new Channel('reports.' . $this->donation->report_id);
        }
        return $channels;
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->donation->id,
            'report_id' => $this->donation->report_id,
            'donor_name' => $this->donation->donor_name,
            'email' => $this->donation->email,
            'amount' => $this->donation->amount,
            'date' => $this->donation->created_at->format('d M Y'),
        ];
    }
}
