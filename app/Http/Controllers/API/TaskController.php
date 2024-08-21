<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Repositories\Interfaces\ITaskRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Task Management System API Documentation",
 *      description="API documentation for the Task Management System",
 * )
 */
class TaskController extends Controller
{
    protected $taskRepository;

    public function __construct(ITaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }
   

     /**
     * @OA\Get(
     *      path="/api/tasks",
     *      operationId="getTasksList",
     *      tags={"Tasks"},
     *      summary="Get list of tasks",
     *      description="Returns list of tasks",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="integer", example=1),
     *              @OA\Property(property="message", type="string", example="get all tasks"),
     *              @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Task"))
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="No tasks found",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="integer", example=0),
     *              @OA\Property(property="error", type="string", example="No tasks found"),
     *              @OA\Property(property="data", type="null")
     *          )
     *      )
     * )
     */
    public function index()
    {
        $tasks = $this->taskRepository->getAllTasks();

        if ($tasks) {
            return Response::success('get all tasks', TaskResource::collection($tasks));
        } else {
            $error='No tasks found';
            Log::error($error);
            return Response::error($error, null, 403);
            
        }
    }

  

    /**
     * @OA\Post(
     *      path="/api/tasks",
     *      operationId="storeTask",
     *      tags={"Tasks"},
     *      summary="Create a new task",
     *      description="Creates a new task and returns the created task",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="title", type="string", description="Task title", example="Complete project"),
     *              @OA\Property(property="description", type="string", description="Task description", example="Finish the project by the end of the week."),
     *              @OA\Property(property="expiration_date", type="string", description="Expiration date", example="1403/05/31"),
     *              @OA\Property(property="priority", type="string", description="Task priority", example="high"),
     *              @OA\Property(property="status", type="string", description="Task status", example="in_progress"),
     *              @OA\Property(property="user_id", type="integer", description="User ID", example=1)
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="integer", example=1),
     *              @OA\Property(property="message", type="string", example="get task"),
     *              @OA\Property(property="data", ref="#/components/schemas/Task")
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Error creating task",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="integer", example=0),
     *              @OA\Property(property="error", type="string", example="No task found"),
     *              @OA\Property(property="data", type="null")
     *          )
     *      )
     * )
     */
    public function store(Request $request)
    {
        $task = $this->taskRepository->storeTask($request->all());

        if ($task) {
            return Response::success('get task', new TaskResource($task));
        } else {
            $error='No task found';
            Log::error($error);
            return Response::error($error, null, 403);
        }
    }


    /**
     * @OA\Put(
     *      path="/api/tasks/{task_id}",
     *      operationId="updateTask",
     *      tags={"Tasks"},
     *      summary="Update an existing task",
     *      description="Updates an existing task and returns the updated task",
     *      @OA\Parameter(
     *          name="task_id",
     *          description="Task ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="title", type="string", description="Task title", example="Complete project"),
     *              @OA\Property(property="description", type="string", description="Task description", example="Finish the project by the end of the week."),
     *              @OA\Property(property="expiration_date", type="string", description="Expiration date", example="1403/05/31"),
     *              @OA\Property(property="priority", type="string", description="Task priority", example="high"),
     *              @OA\Property(property="status", type="string", description="Task status", example="in_progress"),
     *              @OA\Property(property="user_id", type="integer", description="User ID", example=1)
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="integer", example=1),
     *              @OA\Property(property="message", type="string", example="get task"),
     *              @OA\Property(property="data", ref="#/components/schemas/Task")
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Error updating task",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="integer", example=0),
     *              @OA\Property(property="error", type="string", example="No task found"),
     *              @OA\Property(property="data", type="null")
     *          )
     *      )
     * )
     */
    public function update(Request $request, $task_id)
    {
        $task = $this->taskRepository->updateTask($task_id, $request->all());
        if ($task) {
            return Response::success('get task', new TaskResource($task));
        } else {
            $error='No task found';
            Log::error($error);
            return Response::error($error, null, 403);
        }
      
    }


    /**
     * @OA\Delete(
     *      path="/api/tasks/{task_id}",
     *      operationId="deleteTask",
     *      tags={"Tasks"},
     *      summary="Delete an existing task",
     *      description="Deletes a task and returns a success response",
     *      @OA\Parameter(
     *          name="task_id",
     *          description="Task ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Task deleted successfully",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="integer", example=1),
     *              @OA\Property(property="message", type="string", example="task deleted"),
     *              @OA\Property(property="data", type="null")
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Task not found",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="integer", example=0),
     *              @OA\Property(property="error", type="string", example="Task not found"),
     *              @OA\Property(property="data", type="null")
     *          )
     *      )
     * )
     */
    public function destroy($task_id)
    {
        // $this->taskRepository->removeTask($task_id);
        // return Response::success('task deleted', null);
        $task = $this->taskRepository->removeTask($task_id);

        if ($task) {
            return Response::success('task deleted', null);
        } else {
            $error = 'Task not found';
            Log::error($error);
            return Response::error($error, null, 404);
        }
    }


    /**
     * @OA\Get(
     *      path="/api/tasks/user/{user_id}",
     *      operationId="getUserTasks",
     *      tags={"Tasks"},
     *      summary="Get all tasks for a specific user",
     *      description="Returns a list of tasks associated with the given user",
     *      @OA\Parameter(
     *          name="user_id",
     *          description="User ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="integer", example=1),
     *              @OA\Property(property="message", type="string", example="get all user tasks"),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(property="id", type="integer", example=1),
     *                      @OA\Property(property="title", type="string", example="Task Title"),
     *                      @OA\Property(property="description", type="string", example="Task Description"),
     *                      @OA\Property(property="expiration_date", type="string", format="date", example="1403/05/31"),
     *                      @OA\Property(property="priority", type="string", example="high"),
     *                      @OA\Property(property="status", type="string", example="in_progress"),
     *                      @OA\Property(property="user_id", type="integer", example=1)
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="No tasks found",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="integer", example=0),
     *              @OA\Property(property="error", type="string", example="No tasks found"),
     *              @OA\Property(property="data", type="null")
     *          )
     *      )
     * )
     */
    public function userTasks($user_id)
    {
        $tasks = $this->taskRepository->getUserTasks($user_id);

        if ($tasks) {
            return Response::success('get all user tasks', TaskResource::collection($tasks));
        } else {
            $error='No tasks found';
            Log::error($error);
            return Response::error($error, null, 403);
        }
    }


   /**
     * @OA\Put(
     *      path="/api/tasks/update-status/{task_id}",
     *      operationId="updateStatus",
     *      tags={"Tasks"},
     *      summary="Update the status of a task",
     *      description="Updates the status of a specific task",
     *      @OA\Parameter(
     *          name="task_id",
     *          description="Task ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(property="status", type="string", example="completed")
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Task status updated successfully",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="integer", example=1),
     *              @OA\Property(property="message", type="string", example="get task"),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(property="id", type="integer", example=1),
     *                  @OA\Property(property="title", type="string", example="Task Title"),
     *                  @OA\Property(property="description", type="string", example="Task Description"),
     *                  @OA\Property(property="expiration_date", type="string", format="date", example="1403/05/31"),
     *                  @OA\Property(property="priority", type="string", example="high"),
     *                  @OA\Property(property="status", type="string", example="completed"),
     *                  @OA\Property(property="user_id", type="integer", example=1)
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="No task found",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="integer", example=0),
     *              @OA\Property(property="error", type="string", example="No task found"),
     *              @OA\Property(property="data", type="null")
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation Error",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="status", type="integer", example=0),
     *              @OA\Property(property="error", type="string", example="Validation failed"),
     *              @OA\Property(property="data", type="null")
     *          )
     *      )
     * )
     */
    public function updateStatus(Request $request, string $task_id)
    {
        $request->validate([
            'status' => 'required|in:deferred,in_progress,completed',
        ]);
        $task = $this->taskRepository->updateStatusTask($task_id, $request->input('status'));
        
        if ($task) {
            return Response::success('get task', new TaskResource($task));
        } else {
            $error='No task found';
            Log::error($error);
            return Response::error($error, null, 403);
        }
    }


    

   
    
}
