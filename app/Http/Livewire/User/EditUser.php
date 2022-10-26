<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;

class EditUser extends Component
{
    public $user;
    public $name;
    public $email;
    public $role;
    public $team;

    /**
     * Validation rules
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'role' => 'nullable',
            'email' => 'required',
        ];
    }

    public function loadModel($user_id)
    {
        $model = User::where('userId', $user_id)->first();
        $this->user = $model;
        $this->name = $model->name;
        $this->email = $model->email;
        $this->role = $model->roles;
        $this->team = $model->team;
    }

    public function update()
    {
        $this->validate();
        $this->user->update($this->modelData());
        $this->user->syncRoles($this->role);
        session()->flash('flash.banner', 'User saved successfully');
        session()->flash('flash.bannerStyle', 'success');
    }

    public function modelData(){
        return [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'team' => $this->team,
        ];
    }

    public function render()
    {
        return view('livewire.user.edit-user')->layout('layouts.frontpage');
    }
}
