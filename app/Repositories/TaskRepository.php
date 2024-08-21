<?php

namespace App\Repositories;

use App\Events\TaskCompleted;
use App\Events\TaskCreated;
use App\Jobs\ProcessCriticalTask;
use App\Models\Task;
use App\Repositories\Interfaces\ITaskRepository;

class TaskRepository implements ITaskRepository
{
    protected $model;
    public function __construct(Task $model)
    {
        $this->model = $model;
    }


    public function getAllTasks()
    {
        return  $this->model->latest()->get();
    }


    public function storeTask($data)
    {
        
        $task=$this->model->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'expiration_date' => $data['expiration_date'], 
            'priority' => $data['priority'],
            'status' => $data['status'],
            'user_id' => $data['user_id'],
        ]);

        broadcast(new TaskCreated())->toOthers();
        
        if ($task->priority == 'بالا') {
            ProcessCriticalTask::dispatch($task)->onQueue('critical');
        }
        
        return $task;
    }

    public function updateTask($task_id, $data)
    {
        $task = $this->model->findOrFail($task_id);
        $task->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'expiration_date' => $data['expiration_date'],
            'priority' => $data['priority'],
            'status' => $data['status'],
            'user_id' => $data['user_id'],
        ]);

        if ($task->status == 'کامل شده') {
            broadcast(new TaskCompleted($task))->toOthers();
        }
        
        if ($task->priority == 'بالا') {
            ProcessCriticalTask::dispatch($task)->onQueue('critical');
        }
        
        return $task;
    }


    public function removeTask($task_id){
        $task = $this->model->find($task_id);
        if ($task) {
            return $task->delete();
        }
        return false;
    }


    public function getUserTasks($user_id)
    {
        return  $this->model->where('user_id', $user_id)->latest()->get();
    }

    public function updateStatusTask(string $task_id, string $status)
    {
        $task = Task::findOrFail($task_id);
        $task->status = $status;
        $task->save();

        broadcast(new TaskCreated())->toOthers();

        if ($task->status == 'کامل شده') {
            broadcast(new TaskCompleted($task))->toOthers();
        }
        
        return $task;
    }

    
}