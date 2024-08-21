<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ShowTask extends Component
{
    public Task $task;
    public $title;
    public $description;
    public $expiration_date;
    public $priority;
    public $status;


    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'expiration_date' => 'required|date',
    ];

    public function update()
    {
        $this->validate();

        $task_id = $this->task->id;
        $url = env('API_BASE_URL') . "/tasks/$task_id";
        $response = Http::put($url, [
            'title' => $this->title,
            'description' => $this->description,
            'expiration_date' => $this->expiration_date,
            'priority' => $this->priority,
            'status' => $this->status,
            'user_id' => auth()->user()->id,
        ]);

        if($response->json()['status'] == 1) {
            return $this->redirect(route('dashboard'), navigate: true);
        } else {
            $error = $response->json()['error'];
            session()->flash('error', $error);
        }
    }
 
    public function mount($id) 
    {
        $this->task = Task::findOrFail($id);
        $this->title = $this->task->title;
        $this->description = $this->task->description;
        $this->expiration_date = $this->task->expiration_date;
        $this->priority = $this->task->priority;
        $this->status = $this->task->status;
    }

    public function render()
    {
        return view('livewire.tasks.show-task');
    }
}
