<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EditPage extends Component
{
    public $urlslug;
    public $page;

    public function mount($urlslug = null)
    {
        $this->urlslug = $urlslug;
    }

    public function render()
    {
        return view('livewire.edit-page')->layout('layouts.frontpage');
    }
}
