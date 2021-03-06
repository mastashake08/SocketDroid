<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendSms implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
    public $command, $device,$text,$phone;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id,$text=null,$phone=null)
    {
        //
        $this->command = 'sms-send';
        $this->device = \App\Device::find($id);
        $this->text = $text;
        $this->phone = $phone;

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
