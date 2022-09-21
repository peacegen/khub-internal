<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EditPage extends Component
{
    public function render()
    {
        return view('livewire.edit-page')->layout('layouts.frontpage');
    }
}
