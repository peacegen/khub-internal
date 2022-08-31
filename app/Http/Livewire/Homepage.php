<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;
use App\Models\Tag;
use PHPUnit\Framework\Constraint\IsEmpty;


class Homepage extends Component
{
    public $pages;
    public $tags;

    public function loadPages() {
        // TODO add loading by tag
        $this->pages = Page::all();
        return ['none' => $this->pages];
    }

    public function loadPagesByTag() {
        $this->tags = Tag::all();
        // dd($this->tags);
        if (empty($this->tags)) {
            return $this->loadPages();
        }
        foreach ($this->tags as $tag) {
            $this->pages[$tag->name] = ['name' => $tag->name, 'description' => $tag->description, 'items' => $tag->pages];
        }

        // $this->pages['none'] = Pages::where();
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
        $data = $this->loadPagesByTag();

        // dd($data);
        return view('livewire.homepage', [
            'data' => $data
        ])->layout('layouts.frontpage');
    }
}
