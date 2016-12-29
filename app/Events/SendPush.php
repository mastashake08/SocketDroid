<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendPush implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
    public $title,$message,$device,$command;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($title,$message,\App\Device $device)
    {
        //
        $this->title = $title;
        $this->message = $message;
        $this->device = $device;
        $this->command = 'push';
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
