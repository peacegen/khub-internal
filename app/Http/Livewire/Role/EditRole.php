<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;

class EditRole extends Component
{
    public $role;
    public $name;
    public $permissions = [];

    public function rules()
    {
        return [
            'name' => 'required',
            'permissions' => 'required',
        ];
    }

    public function render()
    {
        return view('livewire.role.edit-role');
    }
}
