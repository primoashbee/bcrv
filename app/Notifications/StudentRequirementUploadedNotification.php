<?php

namespace App\Notifications;

use App\StudentRequirement;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Channels\StudentRequirementChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\StudentRequirementUploadedEvent;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;

class StudentRequirementUploadedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    private $studentRequirement;
    private $notificationData;
    private $to_admin;
    private $uuid;
    public function __construct(StudentRequirement $studentRequirement, $to_admin=false)
    {
        $this->studentRequirement = $studentRequirement;
        $this->notificationData = $studentRequirement->notificationData($to_admin);
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
            'message' => $this->notificationData['message'],
            'title' => $this->notificationData['title'],
            'link'  => route('requirements.uploaded',['requirement_id'=> $this->studentRequirement->id]),
            'status' => 200
        ];
    }

    public function toBroadcast($notifiable)
    {
        if($this->to_admin){
            $data = [
                'notifiable' => $notifiable,
                'message' => $this->notificationData['message'],
                'title' => $this->notificationData['title'],
                'link'  => route('requirements.uploaded',['requirement_id'=> $this->studentRequirement->id]),
                'status' => 200
            ];
            $notification = $notifiable->notifications()->first();
         event(new StudentRequirementUploadedEvent($this->studentRequirement, $notification ));
        }
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

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        dd('to_array');
        return [
            'notifiable' => $notifiable,
            'message' => $this->notificationData['message'],
            'title' => $this->notificationData['title'],
            'link'  => route('requirements.uploaded',['requirement_id'=> $this->studentRequirement->id]),
            'status' => 200
        ];
    }
}
