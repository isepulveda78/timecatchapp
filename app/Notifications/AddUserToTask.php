<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AddUserToTask extends Notification
{
    use Queueable;

    /**
     * Assigned Task
     * @var Task
     */
    public $task;


    public function __construct(Task $task)
    {
        $this->task = $task;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You have been assigned a task.')
                    ->action('View Assigned Task', url('/tasks'))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
