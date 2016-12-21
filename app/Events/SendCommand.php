<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendCommand implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
    public $command, $device;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($command,$id)
    {
        //
        $this->command = $command;
        $this->device = \App\Device::find($id);

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {

        return new Channel($this->device->phone);
    }
}
