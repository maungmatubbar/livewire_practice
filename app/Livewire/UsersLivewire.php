<?php

namespace App\Livewire;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UsersLivewire extends Component
{
    #[Validate('required|max:10', message: 'Please enter your name')]
    public $name= '';
    #[Validate('required|email', message: 'Please enter your email')]
    public $email= '';

    #[Validate('required|min:5',message: 'Please enter your password')]
    public $password= '';
    public function createUser()
    {
        $this->validate();
    }
    public function render()
    {
        return view('livewire.users-livewire');
    }
}
