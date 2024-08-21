<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            return $this->redirect(route('dashboard'), navigate: true);
        } else {
            $this->addError('email', __('These credentials do not match our records.'));
        }
    }
    
    public function render()
    {
        return view('livewire.login');
    }
}
