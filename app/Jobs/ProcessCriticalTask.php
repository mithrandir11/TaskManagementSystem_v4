<?php

namespace App\Jobs;

use App\Events\TaskProcessed;
use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCriticalTask implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $task;
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        broadcast(new TaskProcessed($this->task))->toOthers();
    }
}
