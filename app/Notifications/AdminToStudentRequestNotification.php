<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Channels\StudentRequirementChannel;
use App\Events\AdminToStudentRequestEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\PrimaryModels\RequeststoStudents;
use Illuminate\Notifications\Messages\MailMessage;

class AdminToStudentRequestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    private $data;
    private $to_admin;
    public function __construct(RequeststoStudents $request_to_students, $to_admin = false)
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        // dd($this->data->notificationData());
        return [
            'notifiable' => $notifiable,
            'message' => $this->data->notificationData()['message'],
            'title' => $this->data->notificationData()['title'],
            'link'  => route('request.from.admin.view',['id'=> $this->data->id]),
            'status' => 200
        ];
    }


    public function toBroadcast($notifiable)
    {
        $data = [
            'notifiable' => $notifiable,
            'message' => $this->data->notificationData()['message'],
            'title' => $this->data->notificationData()['title'],
            'link'  => route('request.from.admin.view',['id'=> $this->data->id]),
            'status' => 200
        ];
        $notification = $notifiable->notifications()->first();
        event(new AdminToStudentRequestEvent($this->data, $notification ));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
