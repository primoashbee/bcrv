<?php

namespace App\Events;

use App\Models\PrimaryModels\RequeststoStudents;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AdminToStudentRequestEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    private $requirement;
    public $message;
    public $data;
    public function __construct(RequeststoStudents $requirement, $notification)
    {
        $this->requirement = $requirement;
        // $this->data = $notification;
        $this->message = $requirement->notificationData();
        $this->data = $requirement->user->notifications()->orderBy('id','desc')->first();
        // dd($requirement->user->notifications()->orderBy('id','desc')->first());
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('user.notifications.' . $this->requirement->student_id);
    }
    public function broadcastAs()
    {
        return 'requirement-updated';
    }
}
