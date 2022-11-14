<?php

namespace App\Http\Livewire\Role;

use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EditRole extends Component
{
    public $role;
    public $name;
    public $permissions = [];
    public $permissions_list;
    public $isTrue;

    // mount function
    public function mount($id)
    {
        if ($id=="new") {
            $this->isNew = true;
            $this->permissions_list = Permission::all();
        } else {
            $this->role = Role::find($id);
            $this->name = $this->role->name;
            $this->permissions = $this->role->permissions->pluck('name')->toArray();
            $this->permissions_list = Permission::all();
        }
    }

    public function create(){
        $this->validate([
            'name' => 'required|unique:roles,name',
        ]);
        $role = Role::create(['name' => $this->name, 'guard_name' => 'web']);
        Debugbar::info($this->permissions);
        foreach ($this->permissions as $permission) {
            $role->givePermissionTo(Permission::where('name', $permission)->first());
        }
        return redirect()->route('edit-roles');
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
