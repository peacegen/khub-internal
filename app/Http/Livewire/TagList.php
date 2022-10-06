<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Page;
use Barryvdh\Debugbar\Facades\Debugbar;

class TagList extends Component
{
    public $pages;
    public $pageList;
    public $search;
    public $tag;

    public function mount($tag)
    {
        $this->tag = $tag;
        // $this->pages = Page::whereHas('tags', function ($query) {
        //     $query->where('name', $this->tag);
        // })->get();
        Debugbar::info("hello");
        // Debugbar::info($this->pages);
    }

    public function render()
    {
        $this->pageList = Page::where('title', 'like', '%' . $this->search . '%')
                ->whereHas('tags', function ($query) {
                    $query->where('name', $this->tag);
                })
                ->get();
        return view('livewire.tag-list')->layout('layouts.frontpage');
    }
}
