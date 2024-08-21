<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    public $user_id;
    public $tasks = [];

    public function removeTask($task_id)
    {
        $url = env('API_BASE_URL') . "/tasks/$task_id";
        $response = Http::delete($url);

        if($response->json()['status'] == 1) {
            //
        } else {
            $error = $response->json()['error'];
            session()->flash('error', $error);
        }
        
        $this->fetchTasks();
    }

    public function updateStatus($task_id, $status)
    {

        $url = env('API_BASE_URL') . "/tasks/update-status/$task_id";
        $response = Http::put($url, [
            'status' => $status
        ]);

        if($response->json()['status'] == 1) {
            //
        } else {
            $error = $response->json()['error'];
            session()->flash('error', $error);
        }
        
        $this->fetchTasks();
    }
    

    public function fetchTasks()
    {
        $url = env('API_BASE_URL') . "/tasks/user/$this->user_id";
        $response = Http::get($url);

        if($response->json()['status'] == 1) {
            $this->tasks = $response->json()['data'];
        } else {
            $error = $response->json()['error'];
            session()->flash('error', $error);
        }
    }

    public function logout()
    {
        Auth::logout();
        return $this->redirect(route('login'), navigate: true);
    }


    public function mount()
    {
        $this->user_id = auth()->user()->id;
        $this->fetchTasks();
    }
    

    #[Title('dashboard')] 
    public function render()
    {
        return view('livewire.dashboard');
    }
}
