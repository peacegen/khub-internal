<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class Roles extends Component
{
    public function render()
    {
        return view('livewire.roles', [
        ]);
    }
}
