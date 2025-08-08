<?php

namespace App\Events;

use Auth;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\Conversation;

class ChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $room_id;
    public $user;

    public function __construct($message, $room_id, $user)
    {
        $this->message = $message;
        $this->room_id = $room_id;
        $this->user = $user;
    }

    public function broadcastOn()
    {
        return ['rooms.' . $this->room_id];
    }

}
