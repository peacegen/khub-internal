<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;

class EditUser extends Component
{
    public $user;
    public $name;
    public $email;
    public $role;
    public $team;
    public $role_list;
    public $team_list;

    public function mount($id)
    {
        $this->loadModel($id);
    }

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
        $model = User::where('id', $user_id)->first();
        $this->user = $model;
        $this->name = $model->name;
        $this->email = $model->email;
        $this->role = $model->roles;
        $this->teams = $model->teams;
        $this->role_list = \Spatie\Permission\Models\Role::all();
        $this->team_list = \App\Models\Team::all();
    }

    public function update()
    {
        $this->validate();
        $this->user->update($this->modelData());
        $this->user->syncRoles($this->role);
        session()->flash('flash.banner', 'User saved successfully');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('edit-users');
    }

    public function modelData(){
        return [
            'name' => $this->name,
            'email' => $this->email,
            'team' => 'user',
        ];
    }

    public function render()
    {
        return view('livewire.user.edit-user')->layout('layouts.frontpage');
    }
}
