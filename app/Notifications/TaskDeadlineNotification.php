<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskDeadlineNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private Task $task
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('Reminder! Task deadline approaching!')
            ->line('Task ' . $this->task->getName() . ' is due tomorrow')
            ->action('View My Tasks', url('/tasks'))
            ->line('Take action before deadline.');
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}
