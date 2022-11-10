<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public $modalConfirmDeleteVisible;
    public $modelId;

    public function update($modelId)
    {
        return redirect()->route('edit-role-id', ['id' => $modelId]);
    }

    public function delete()
    {
        Role::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
    }

    public function deleteShowModal($modelId)
    {
        $this->modelId = $modelId;
        $this->modalConfirmDeleteVisible = true;
    }

    public function render()
    {
        return view('livewire.role.roles', [
            'data' => Role::paginate(20),
        ]);
    }
}
