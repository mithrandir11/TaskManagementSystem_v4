<?php

namespace App\Livewire\Tasks;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Form extends Component
{
    public $title;
    public $description;
    public $expiration_date;
    public $priority = 'medium';
    public $status = 'completed';

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'expiration_date' => 'required|date',
        'priority' => 'required|in:high,medium,low',
        'status' => 'required|in:deferred,in_progress,completed',
    ];

    public function store()
    {
        $this->validate();

        $url = env('API_BASE_URL') . '/tasks';
        $response = Http::post($url, [
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

    public function render()
    {
        return view('livewire.tasks.form');
    }
}
