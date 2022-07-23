<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class StudentRequirementChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toBroadcast($notifiable);
    }

    
}