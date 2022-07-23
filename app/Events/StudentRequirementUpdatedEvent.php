<?php

namespace App\Events;

use App\StudentRequirement;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StudentRequirementUpdatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    private $studentRequirement;
    public $message;
    public $data;
    public function __construct(StudentRequirement $studentRequirement, $data)
    {
        $this->studentRequirement = $studentRequirement;
        $this->message = $studentRequirement->notificationData();
        $this->data = $studentRequirement->student->notifications()->orderBy('id','desc')->first();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('user.notifications.' . $this->studentRequirement->user_id);
    }

    public function broadcastAs()
    {
        return 'requirement-updated';
    }
}
