<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BatteryLevel implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
    public $battery;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($battery)
    {
        //
        $this->battery = $battery;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('battery');
    }
}
