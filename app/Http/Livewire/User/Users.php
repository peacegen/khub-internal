<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class Users extends Component
{
    public function render()
    {
        // return view('admin.users');
        return view('livewire.user.users', [
            'data' => \App\Models\User::paginate(20),
        ]);
    }
}
