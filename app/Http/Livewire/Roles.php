<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;

class Roles extends Component
{
    public $modalConfirmDeleteVisible;
    public $modelId;

    public function update($modelId)
    {
        return redirect()->route('edit-user-id', ['id' => $modelId]);
    }

    public function delete()
    {
        Role::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        // $this->resetPage();
    }

    public function deleteShowModal($modelId)
    {
        $this->modelId = $modelId;
        $this->modalConfirmDeleteVisible = true;
    }

    public function render()
    {
        // return view('admin.users');
        return view('livewire.user.users', [
            'data' => \App\Models\User::paginate(20),
        ]);
    }
}
