<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;

class Homepage extends Component
{
    public $pages;

    public function loadPages() {
        // TODO add loading by tag
        $this->pages = Page::all();
        return $this->pages;
    }

    public function render()
    {
    //     $items = [[
    //         'content' => "test",
    //         'image-url' => "https://via.placeholder.com/150",
    //     ],
    //     [
    //         'content' => "test1",
    //         'image-url' => null,
    //     ]
    // ];
        $data = $this->loadPages();

        return view('livewire.homepage', [
            'data' => $this->data
        ]);
    }
}
