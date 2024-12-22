<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Notifications\TaskDeadlineNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendTaskDeadlineNotifications extends Command
{
    private const INFO = 'Sent successfully';

    protected $signature = 'tasks:send-deadline-notifications';
    protected $description = 'Send email task deadline notifications';

    public function handle(): void
    {
        $tasks = Task::where(Task::DUE_DATE, Carbon::tomorrow())->get();

        foreach ($tasks as $task) {
            $task->user->notify(new TaskDeadlineNotification($task));
        }

        $this->info(self::INFO);
    }
}
