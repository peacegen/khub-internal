<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EditRole extends Component
{
    public $role;
    public $name;
    public $permissions = [];
    public $permissions_list;

    // mount function
    public function mount($id)
    {
        $this->role = Role::find($id);
        $this->name = $this->role->name;
        $this->permissions = $this->role->permissions->pluck('name')->toArray();
        $this->permissions_list = Permission::all();
    }

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
