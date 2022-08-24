<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Homepage extends Component
{
    public function render()
    {
        $items = [[
            'content' => "test",
            'image-url' => "https://via.placeholder.com/150",
        ],
        [
            'content' => "test1",
            'image-url' => null,
        ]
    ];

        return view('livewire.homepage', [
            'items' => $items
        ]);
    }
}
