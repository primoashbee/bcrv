<?php

namespace App\Events;

use App\Models\PrimaryModels\RequestModel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StudentToAdminRequestEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    private $requestModel;
    private $to_admin;
    public $data;
    public $message;

    public function __construct(RequestModel $requestModel, $notification, $to_admin = true)
    {
        $this->requestModel = $requestModel;
        $this->data = $notification;
        $this->message = $requestModel->notificationData(true);
        $this->to_admin = $to_admin;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        if($this->to_admin){
            return new Channel('user.notifications.1'); //static admin id
        }else{
            return new Channel('user.notifications.'.  RequestModel::find($this->requestModel->id)->studentInfo->user->id); //static admin id
        }

    }

    public function broadcastAs()
    {
        if($this->to_admin){
        return 'student-uploaded-requirement';
        }
        return 'requirement-updated';

    }
}
