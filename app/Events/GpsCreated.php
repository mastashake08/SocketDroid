<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class GpsCreated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
    public $gps;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Gps $gps)
    {
        //
        \Log::info("Event Fired");
        $this->gps = $gps;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('gps');
    }
}
