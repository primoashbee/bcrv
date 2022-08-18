<?php

namespace App\Notifications;

use App\Channels\StudentRequirementChannel;
use App\Events\UserAccountEvent;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserAccountNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $user;
    private $notificationData;
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->notificationData = $user->notificationData();
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


    public function toDatabase($notifiable){
        return [
            'notifiable' => $notifiable,
            'message' => $this->notificationData['message'],
            'title' => $this->notificationData['title'],
            'link'  => '/show_users?id=' . $this->user->id,
            'status' => 200
        ];
    }

    public function toBroadcast($notifiable){
        $notification = $notifiable->notifications()->first();
        event(new UserAccountEvent($this->user, $notification ));
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
