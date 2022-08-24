<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Homepage extends Component
{
    public function render()
    {
        $items = [
            'content' => "test",
        ];

        return view('livewire.homepage', [
            'items' => $items
        ]);
    }
}
