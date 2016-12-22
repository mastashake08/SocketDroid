<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ActivatedDevice implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
    public $device
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Device $device)
    {
        //
        $this->device = $device;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel($device->uuid);
    }
}
