<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $modalConfirmDeleteVisible;
    public $modelId;

    public function update($modelId)
    {}

    public function delete()
    {
        User::destroy($this->modelId);
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
