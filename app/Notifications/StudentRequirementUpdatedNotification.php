<?php

namespace App\Notifications;

use App\StudentRequirement;
use Illuminate\Bus\Queueable;
use App\Channels\StudentRequiementChannel;
use Illuminate\Notifications\Notification;
use App\Channels\StudentRequirementChannel;
use App\Events\StudentRequirementUpdatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StudentRequirementUpdatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $studentRequirement;
    private $notificationData;

    public function __construct(StudentRequirement $studentRequirement)
    {
        $this->studentRequirement = $studentRequirement;
        $this->notificationData = $studentRequirement->notificationData();
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
            'link'  => route('requirements'),
            'status' => 200
        ];
    }

    public function toBroadcast($notifiable)
    {
        $data =  [
            'notifiable' => $notifiable,
            'message' => $this->notificationData['message'],
            'title' => $this->notificationData['title'],
            'link'  => route('requirements'),
            'status' => 200
        ];
       event(new StudentRequirementUpdatedEvent($this->studentRequirement, $data));
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
        return [
            //
        ];
    }
}
