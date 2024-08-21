<?php

namespace App\Repositories\Interfaces;

interface ITaskRepository 
{
    public function getAllTasks();
    public function storeTask($data);
    public function updateTask($task_id, $data);
    public function getUserTasks($user_id);
    public function updateStatusTask(string $task_id, string $status);
    public function removeTask($task_id);
}