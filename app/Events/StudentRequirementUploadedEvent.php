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
use Illuminate\Notifications\DatabaseNotification;

class StudentRequirementUploadedEvent implements ShouldBroadcast
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
    public function __construct(StudentRequirement $studentRequirement, $notification)
    {
        $this->studentRequirement = $studentRequirement;
        $this->message = $studentRequirement->notificationData(false);
        // $this->data = DatabaseNotification::find($uuid);
        $this->data = $notification;
        // dd($this->data);
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('user.notifications.1'); //static admin id
    }

    public function broadcastAs()
    {
        return 'student-uploaded-requirement';
    }
}
