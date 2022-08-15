<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Events\StudentToAdminRequestEvent;
use App\Models\PrimaryModels\RequestModel;
use Illuminate\Notifications\Notification;
use App\Channels\StudentRequirementChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StudentToAdminRequestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    
    private $requestModel;
    private $notificationData;
    private $to_admin;
    public function __construct(RequestModel $requestModel, $to_admin= true)
    {
        $this->requestModel = $requestModel;
        $this->to_admin = $to_admin;
        $this->notificationData = $requestModel->notificationData($to_admin);
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


    public function toBroadcast($notifiable)
    {
        $notification = $notifiable->notifications()->first();
        event(new StudentToAdminRequestEvent($this->requestModel, $notification, $this->to_admin));

    }

    public function toDatabase($notifiable)
    {   
        if($this->to_admin){
            return [
                'notifiable' => $notifiable,
                'message' => $this->notificationData['message'],
                'title' => $this->notificationData['title'],
                'link'  => route('admin.response.to.request',['id'=> $this->requestModel->id]),
                'status' => 200
            ];
        }
        return [
            'notifiable' => $notifiable,
            'message' => $this->notificationData['message'],
            'title' => $this->notificationData['title'],
            'link'  => route('request.preview',['id'=> $this->requestModel->id]),
            'status' => 200
        ];
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
