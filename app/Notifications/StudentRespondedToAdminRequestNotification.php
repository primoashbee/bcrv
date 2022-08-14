<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Channels\StudentRequirementChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\PrimaryModels\RequeststoStudents;
use Illuminate\Notifications\Messages\MailMessage;
use App\Events\StudentRespondedToAdminRequestEvent;

class StudentRespondedToAdminRequestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $data;
    private $to_admin;
    public function __construct(RequeststoStudents $request_to_students, $to_admin = true)
    {
        $this->data = $request_to_students;
        $this->to_admin = $to_admin;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', StudentRequirementChannel::class];
    }
    public function toDatabase($notifiable)
    {
        return [
            'notifiable' => $notifiable,
            'message' => $this->data->notificationData(true)['message'],
            'title' => $this->data->notificationData(true)['title'],
            'link'  => route('request.admin.to.student',['id'=> $this->data->id]),
            'status' => 200
        ];
    }

    
    public function toBroadcast($notifiable)
    {
        $data = [
            'notifiable' => $notifiable,
            'message' => $this->data->notificationData(true)['message'],
            'title' => $this->data->notificationData(true)['title'],
            'link'  => route('request.admin.to.student',['id'=> $this->data->id]),
            'status' => 200
        ];
        $notification = $notifiable->notifications()->first();
        event(new StudentRespondedToAdminRequestEvent($this->data, $notification ));
    }
}
